<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Ciao, è stato creato un nuovo post!</h1>
    <p><strong>hola</strong>Ciao</p>
    <div>{{$new_post->title}}</div>
    <a href="{{ route('admin.posts.show', ['post' => $new_post->slug]) }}">Post</a>
</body>
</html>