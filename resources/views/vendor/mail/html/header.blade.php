<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://cdn.wallpapersafari.com/11/36/V3aAmS.jpg" class="logo" alt="Doctors Center">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
