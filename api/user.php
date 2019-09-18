<?php 

	require_once('../Models/User.php');
	require_once('../http/RequestRoute.php');
	require_once('../http/Response.php');

	RequestRoute::GET(function() {
		$user = new User;
		$result = $user->getAll();
		return new Response($result, 200);
	});
?>