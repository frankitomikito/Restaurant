<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/Models/User.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/RequestRoute.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/Response.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/http/Mail/Mail.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/Models/UserCode.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/Models/ImageUploader.php');

	RequestRoute::GET(function() {
		$user = new User;
		$result = $user->getAll();
		return new Response($result, 200);
	});

	RequestRoute::POST(function() {
		$image_path = RequestRoute::PARAMFILE('user_image') ? 
			ImageUploader::uploadImage(RequestRoute::PARAMFILE('user_image')) :
			'images/012fdcec1c1935fa3971afc1c54931a5.jpg';
		$data = [
			'fullname' => RequestRoute::PARAMPOST('fullname'),
			'email' => RequestRoute::PARAMPOST('email'),
			'address' => RequestRoute::PARAMPOST('address'),
			'position' => (int)RequestRoute::PARAMPOST('position'),
			'gender' => (int)RequestRoute::PARAMPOST('gender'),
			'image_path' => $image_path
		];
		$user = new User;
		$is_email_exist = $user->search([
			'search' => 'email',
			'value' => $data['email']
		]);
		if (!$is_email_exist) {
			$result = $user->create($data);
			if ($result['status']){
				$user = $user->search([
					'search' => 'user_id'
				]);
	
				$user_code = new UserCode;
				$code_generated = $user_code->create(['user_id' => $user->user_id]);
	
				$mail = new Mail;
				$mail->setRecipients('Account Confirmation', 
					'Hello '.$user->fullname.', please click this
					 <a href="http://localhost:8000/account/confirmation?code='.$code_generated.'">link</a> to confirm.',
					 $user->email);
				if ($mail->send()) 
					return new Response(['status' => true], 200);
				else 
					return new Response(['error' => 'Something went wrong'], 404);
			}
			else 
				return new Response(['error' => 'Something went wrong'], 404);
		}
		else {
			return new Response(['error' => 'Email already exist.'], 200);
		}
		
	});

	RequestRoute::PUT(function() {
		$val = RequestRoute::PARAMPUT('kaon');
		return new Response($val, 200);
	});
?>