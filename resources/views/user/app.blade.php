<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            margin:0;
            font-family:'Crimson Text', serif;
            background:#f5f5f5;
        }

        .container{
            max-width:1200px;
            margin:auto;
            padding:20px 40px;
        }
    </style>
</head>
<body>

@yield('content')

</body>
</html>