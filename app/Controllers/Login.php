<?php

namespace App\Controllers;
use App\Libraries\Firebase; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{

	use ResponseTrait;
	
	public function iniciar()
	{
		
		$json = file_get_contents('php://input');
        $dataLogin = json_decode($json);
		$firebase = new Firebase();
		$data = [
            'email'  => $dataLogin->email,
            'password'  => $dataLogin->password,
            'returnSecureToken' => true
        ];

		$result = $firebase->login(json_encode($data));
		
		return $this->respond($result);
	}

	public function validToken()
	{
		$json = file_get_contents('php://input');
        $dataLogin = json_decode($json);
		
		$firebase = new Firebase();
		$data = [
            'refresh_token'  => 'AFxQ4_pZjBonhwX6MbqNOOMObYfR-ixQ5M4Rg5kVLbeQ3AWgJrYJxvu1sUjV2RwO9znHBNwJlhk7vEu6QYd_DNZnAQ8iIPTJoEi0KofPNCXIm4ZadzLg2wcn-S2AGCljPoc_RRCwQHTaxjzt8UEqhSnPaSBb521AdMBIpTzIfeIzDUPnOY7pR1GHwnW0GBAkuOZTut5cfzi-WIQ7Na3PSAD3_yfK6XlS0A',
            'returnSecureToken' => true
        ];

		$result = $firebase->validToken($dataLogin->token);
		
		return $this->respond($result);
	}

}