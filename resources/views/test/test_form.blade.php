<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('users.destroy', ['user', 1]) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit">submit</button>
    </form>
</body>
</html>