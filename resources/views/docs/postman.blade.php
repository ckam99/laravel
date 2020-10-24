<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="c" style="width: 100%; height: 100vh">

    </div>
    <script>

        fetch('https://documenter.getpostman.com/view/365993/TVYC8zJs#e9a5c4d6-e257-424f-8309-88ce79e917a6').then(res=>res.body)
        .then(r => {
            document.getElementById('d').innerHTML = r
        })
    </script>
</body>
</html>