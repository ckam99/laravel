<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">

        <style>
           #app {
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
  width: 50%;
  margin: 50px auto;
}
        </style>
    
    </head>
    <body class="bg-grey-light antialiased leading-normal">
        <div id="app" class="flex items-center justify-center mt-16">
            <div class="w-128 bg-white rounded shadow-2xl">
                @foreach ($tweets as $tweet)
                  <tweet :tweet="{{ $tweet }}"></tweet>
                @endforeach
            </div>
        </div>
    
        <script src="js/app.js"></script>
    </body>
</html>
