<!-- resources/views/hello/index.blade.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Hello Laravel!</title>
</head>

<body>
    <h2>Hello Laravel!</h2>

    <h3>コントローラからのメッセージ:</h3>
    <p style="background: #d1fae5; color: #065f46; padding: 1em; border-radius: 0.5em;">
        {{ $message }}
    </p>
    <p style="color: #4b5563;">
        {{ $description }}
    </p>
</body>

</html>