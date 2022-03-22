<?php

namespace App\Controllers;
use App\Models\EstadoCuentaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class EstadoCuenta extends BaseController
{
	use ResponseTrait;

    public function pacientes()
	{
        $estadoCuentaModel = new EstadoCuentaModel();
        $resp["data"]=$estadoCuentaModel->getPacientes();
		return $this->respond($resp);
	}

    
    // public function listaPacientes()
	// {
	// 	$estadoCuentaModel = new EstadoCuentaModel();
	// 	$resp["data"]=$estadoCuentaModel->getListaPacientes($this->request->getVar('cliente'));
	// 	return $this->respond($resp);
	// }

	public function listaPacientes()
    {
        $json = file_get_contents('php://input');
        $dataEstadoCuenta = json_decode($json);
        $estadoCuentaModel = new EstadoCuentaModel();
        $dataEstadoCuenta = $estadoCuentaModel->getListaPacientes($dataEstadoCuenta);
        
        $resp["data"]=$dataEstadoCuenta;
        // $resp["count"] =$estadoCuentaModel->getListaPacientesNums($dataEstadoCuenta)[0];
        return $this->respond($resp);
    }

}