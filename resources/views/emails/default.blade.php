<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subjectLine }}</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>{{ $subjectLine }}</h2>
    <p>{!! nl2br(e($body)) !!}</p>
</body>
</html>
