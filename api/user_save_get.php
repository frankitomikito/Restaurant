<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/Models/User.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/RequestRoute.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/Response.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/Models/ImageUploader.php');

	RequestRoute::GET(function() {
		$user = new User;
		$result = $user->getAll();
		return new Response($result, 200);
	});

	RequestRoute::POST(function() {
		$data = [
			'fullname' => RequestRoute::PARAMPOST('fullname'),
			'email' => RequestRoute::PARAMPOST('email'),
			'address' => RequestRoute::PARAMPOST('address'),
			'position' => (int)RequestRoute::PARAMPOST('position'),
			'gender' => (int)RequestRoute::PARAMPOST('gender'),
			'image_path' => ImageUploader::uploadImage(RequestRoute::PARAMFILE('user_image'))
		];
		$user = new User;
		$result = $user->create($data);
		if ($result['status']) 
			return new Response(['data' => true], 200);
		else 
			return new Response(['error' => 'Something went wrong'], 404);
	});

	RequestRoute::PUT(function() {

	});
?>