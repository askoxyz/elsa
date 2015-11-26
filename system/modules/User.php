<?php

class User {

	public static function find($email) {

		$users = explode(':', Config::get('users'));
		$foundUser = false;

		foreach($users as $user) {

			$user_email = explode('|', $user)[0];
			$user_password = explode('|', $user)[1];
			$user_status = explode('|', $user)[2];

			if($user_email === $email) {

			 	$foundUser = [
					'email' => $user_email,
					'password' => $user_password,
					'status' => $user_status
				];

				break;

			}

		}

		return json_decode(json_encode($foundUser));

	}

}
