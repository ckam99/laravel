<?php

return [

	/**
	 * Listen port for SocketIO client.
	 */
	'server' => [
		'port' => 3300,
	],

	/**
	 * Events dispatched when SocketIO server is running.
	 */
	'events' => [
		App\Events\SendChatMessage::class,
	],
];
