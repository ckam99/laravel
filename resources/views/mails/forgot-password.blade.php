<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        body{
            background: #f5f5f5;
            font-size: 18px;
        }

        .container{
            margin: 60px auto;
            background: #fff;
            width: 60%;
            height: 50vh;
        }
        .container .header{
            background: #00b08c;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 20px 30px;
        }
        .container .row{
            padding: 30px;
        }
        a{
            color:#00b08c;
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Insets</h1>
        </div>
        <div class="row">
            Click <a href="http://localhost:8080/auth/password/reset/{{$token}}">here</a> to change your password!
        </div>
    </div>
</body>
</html>