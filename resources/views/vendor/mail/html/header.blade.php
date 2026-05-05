@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ config('app.url') }}/img/logo.png" class="logo" alt="NusantaraGreen Logo" style="height: 60px;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
