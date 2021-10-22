<?php

namespace App\Libraries;

class Firebase
{
    private static $token = 'AIzaSyA4ANj9WoYJa4bkSfI4ANHMG8rMLNOlSKQ';
    // This function converts a string into slug format
    public function login($data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         
       // OPTIONS:
       curl_setopt($curl, CURLOPT_URL, 'https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key='. self::$token);
       curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
       ));
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       // EXECUTE:
       $result = curl_exec($curl);
       if(!$result){die("Connection Failure");}
       curl_close($curl);
       return $result;
    }

    // This function converts a string into slug format
    public function validToken($data)
    {
        $curl = curl_init();
       curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=refresh_token&refresh_token=' . $data);  
       // OPTIONS:
       curl_setopt($curl, CURLOPT_URL, 'https://securetoken.googleapis.com/v1/token?key='. self::$token );
       curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/x-www-form-urlencoded',
       ));
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       // EXECUTE:
       $result = curl_exec($curl);
       if(!$result){die("Connection Failure");}
       curl_close($curl);
       return $result;
    }
}