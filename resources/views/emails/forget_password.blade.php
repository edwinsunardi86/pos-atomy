<!DOCTYPE html>
<html>
<head>
    <title>Carpooling</title>
</head>
<body>
    <h3>{{ $details['title'] }}</h3>
     Dear,
    <p>Sehubungan dengan adanya permohonan reset/ganti password
Klik =><a href ="{{ url('/forgetChangePassword') }}/{{ $details['encrypt'] }}"> Untuk Rubah Password </a>
        
    <p>Thank you</p>
</body>+3.
</html>