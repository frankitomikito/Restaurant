<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/Models/User.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/RequestRoute.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/Response.php');

	RequestRoute::GET(function() {
		$user = new User;
		$result = $user->getAll();
		return new Response($result, 200);
	});
?>