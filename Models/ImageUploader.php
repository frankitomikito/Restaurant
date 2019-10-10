<?php 

class ImageUploader {
	public static function uploadImage($file) {
		$target_dir = "../images/profile/";
		$target_file = $target_dir . $file["name"];
		if (move_uploaded_file($file['tmp_name'], $target_file))
			return $target_file;
		else
			return $target_file;
	}
}