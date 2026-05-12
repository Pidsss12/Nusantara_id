<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update Profile Information (Name, Email, Phone)
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update Profile Picture (Avatar)
     */
    public function updateImage(Request $request)
    {
        // 1. Validasi file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('avatar')) {
            try {
                // 2. Hapus foto lama dari storage jika ada (biar gak nyampah)
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // 3. Simpan file baru ke folder 'avatars' di disk 'public'
                // Path akan tersimpan seperti: avatars/namafile.jpg
                $path = $request->file('avatar')->store('avatars', 'public');
                
                // 4. Update path di database
                $user->update([
                    'avatar' => $path
                ]);

                return back()->with('success', 'Profile picture updated successfully!');
                
            } catch (\Exception $e) {
                return back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

        return back()->with('error', 'No image file selected.');
    }

    /**
     * Update Account Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match!']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}