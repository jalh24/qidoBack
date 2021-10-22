<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\Firebase; // Import library

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $obj =  $request->getHeader("Token");
        if(!empty($obj)){
            $firebase = new Firebase();
            $response = json_decode($firebase->validToken($obj->getValue()), true);
            
            if(!empty($response['error'])){
                header("Content-type: application/json");
              
                echo json_encode(array(
                    "status" => false,
                    "message" => "Invalid credentials"
                ));
                die;
            }
        } else{
            header("Content-type: application/json");
              
                echo json_encode(array(
                    "status" => false,
                    "message" => "Invalid credentials"
                ));
                die;
        }
        // Do something here
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}