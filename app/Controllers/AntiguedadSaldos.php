<?php

namespace App\Controllers;
use App\Models\AntiguedadSaldosModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class AntiguedadSaldos extends BaseController
{
	use ResponseTrait;

    public function deudores()
	{
        $antiguedadSaldosModel = new AntiguedadSaldosModel();
        $resp["data"]=$antiguedadSaldosModel->getDeudores();
		return $this->respond($resp);
	}

}