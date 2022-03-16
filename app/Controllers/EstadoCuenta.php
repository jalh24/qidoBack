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

    
    public function listaPacientes()
	{
		$estadoCuentaModel = new EstadoCuentaModel();
		$resp["data"]=$estadoCuentaModel->getListaPacientes($this->request->getVar('cliente'));
		return $this->respond($resp);
	}

}