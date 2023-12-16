<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba - {{$title ?? '' }}</title>
</head>
<body>
    <x-layouts.navegacion/>

    @if(session('status'))
        <div>{{session('status')}}</div>
    @endif
    
    {{$slot}}
</body>
</html>