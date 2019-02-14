@if (strpos($file_type, 'image') !== false)
    <img src="data:{{ $file_type }};base64,{{ $image }}" alt="image">
@else
    <video src="data:{{ $file_type }};base64,{{ $image }}" controls></video>
@endif