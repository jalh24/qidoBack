<?php

namespace App\Controllers;
use App\Models\EstadocuentaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Estadocuenta extends BaseController
{
	use ResponseTrait;

    public function pacientes()
	{
        $estadocuentaModel = new EstadocuentaModel();
        $resp["data"]=$estadocuentaModel->getPacientes();
		return $this->respond($resp);
	}

    
    // public function listaPacientes()
	// {
	// 	$estadocuentaModel = new EstadocuentaModel();
	// 	$resp["data"]=$estadocuentaModel->getListaPacientes($this->request->getVar('cliente'));
	// 	return $this->respond($resp);
	// }

	public function listaPacientes()
    {
        $json = file_get_contents('php://input');
        $dataEstadocuenta = json_decode($json);
        $estadocuentaModel = new EstadocuentaModel();
        $dataEstadocuenta = $estadocuentaModel->getListaPacientes($dataEstadocuenta);
        
        $resp["data"]=$dataEstadocuenta;
        // $resp["count"] =$estadocuentaModel->getListaPacientesNums($dataEstadocuenta)[0];
        return $this->respond($resp);
    }

}