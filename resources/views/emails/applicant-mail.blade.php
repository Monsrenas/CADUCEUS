<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applicant Mail</title>
</head>
<body>
    <h1>Applicant Mail</h1>
    <p>
        We are pleased to announce that, with this email, your accreditation process at our institution begins. 
        To continue, access our platform through the link indicated below
    </p>

    <a href=" {{ route('home') }}" style=" background-color: #199319;
    color: white;
    padding: 10px 10px;
    text-decoration: none;"> Access the platform</a>
    <p>
    The temporary access password is {{$Password}}, you must change it at the first start of the section
    </p>
</body>
</html>
