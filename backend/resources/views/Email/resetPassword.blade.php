
<html lang="en">
<body>
<p>Open link in a new window or tab:
    <a href="http://127.0.0.1:5173/change-password/{{ $token }}" target="_blank">Visit W3Schools!</a></p>
{{ $token }}
Thanks,<br>
{{ config('app.name') }}
</body>
</html>
