<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Styles -->
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card mt-5">
						<div class="card-header">{{ config('app.name') }}</div>

						<div class="card-body">
							<ul id="messages" class="list-group"></ul>
				
							<form class="mt-5">
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="message" autocomplete="off" placeholder="Message">
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">Send</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script>
			$(function(){
				var socket = io("http://localhost:{{ config('laravel-workerman.server.port') }}");
				
				$('form').submit(function(){
					socket.emit('chat message', $('#message').val());
					$('#message').val('');
					return false;
				});
				
				socket.on('chat message', function(message){
					$('#messages').append($('<li class="list-group-item">').text(message));
				});
			});
		</script>
    </body>
</html>
