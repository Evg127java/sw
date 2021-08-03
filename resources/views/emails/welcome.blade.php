<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@component('mail::message')
<h2>Hi <b>{{ $userName }}</b>! Congratulations! You are verified now</h2>
You can use the resource as a verified user, create new and edit existing creatures.
@component('mail::button', ['url' => config('app.url'), 'color' => 'success'])
    Go to StarWars
@endcomponent
@endcomponent
</body>
</html>
