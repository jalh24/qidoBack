<?php

namespace App\Controllers;
use App\Models\AntiguedadsaldosModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Antiguedadsaldos extends BaseController
{
	use ResponseTrait;

    public function deudores()
	{
        $AntiguedadsaldosModel = new AntiguedadsaldosModel();
        $resp["data"]=$AntiguedadsaldosModel->getDeudores();
		return $this->respond($resp);
	}

}