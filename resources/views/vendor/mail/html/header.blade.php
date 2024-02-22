@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/static/ct_2.png'))) }}" alt="{{$slot}}">
@endif
</a>
</td>
</tr>
