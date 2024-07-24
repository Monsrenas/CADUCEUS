<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$Title}}</title>
</head>
<body>
    <h1>{{$Title}}</h1>
    <p>
    {{$Text}} access our platform through the link indicated below
    </p>

    <a href=" {{ route('home') }}" style="display: block;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 4px;
    text-align: center;
    margin: 0 auto;
    border-radius: 5px;
    color: white;
    font-size: .66em;
    ">Access the platform</a>
    <p>
    The temporary access password is {{$Password}}, you must change it at the first start of the section
    </p>
</body>
</html>
