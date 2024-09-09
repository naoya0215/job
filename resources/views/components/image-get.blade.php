@php
$path = 'storage/images/';
@endphp
<div>
    <img src="{{ asset($path . $filename)}}">
</div>
