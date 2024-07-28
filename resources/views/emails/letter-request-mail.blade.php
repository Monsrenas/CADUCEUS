<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$Title}}</title>
</head>
<body style="color: black">
    <h1>{{$Title}}</h1>
    <p style="text-align: justify; line-height: 1.5em; ">
       @if ($reference==0) 
            Dear {{$name}}, I {{$userName}} do hereby request a Letter of Good Standing to be issued on my behalf to the following parties:
            <ol>
                <li>
                    The Council of Medicine and Dentistry/ Nursing and Midwifery/ Allied Health, The Health Professions Authority, The Ministry of Health, Turks and Caicos Islands 
                    Email address of Council 
                </li>
                <li>
                    The Human Resources Department. Turks and Caicos Islands Hospital
                </li>  
            </ol>
        @else
            Dear {{$name}}, you have been selected by {{$userName}} to submit a letter of professional reference on their behalf. Kindly upload a signed copy this document printed on your corporate letter head to this portal. Please remember to include your professional designation beneath the signature line.      
        @endif
    </p>

    <p>
        Please access our platform through the following link to upload, in PDF format, the requested document.
    </p>
    <p>
        <a href=" {{$tmpLink}}" style=" background-color: #199319;
                                        color: white;
                                        padding: 10px 10px;
                                        text-decoration: none;">
            Upload files here
        </a>
    </p>    
    <p>
        Please note that the previous link will be valid for 15 days.
    </p>

    <p>Thank you</p>
</body>
</html>
