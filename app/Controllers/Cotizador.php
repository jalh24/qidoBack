<?php

namespace App\Controllers;
use App\Models\CotizadorModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Cotizador extends BaseController
{

	use ResponseTrait;
	
	// public function costoTurno()
	// {
	// 	$cotizadorModel = new CotizadorModel();	
    //     $resp["data"]=$cotizadorModel->getCostoTurno();
	// 	return $this->respond($resp);
	// }

    // public function gastoServicio()
	// {
	// 	$cotizadorModel = new CotizadorModel();	
    //     $resp["data"]=$cotizadorModel->getGastoServicio();
	// 	return $this->respond($resp);
	// }

    public function costoTurno()
	{
		$cotizadorModel = new CotizadorModel();	
		$resp["data"]=$cotizadorModel->getCostoTurno($this->request->getVar('idTipoCosto'));
		return $this->respond($resp);
	}

    public function gastoServicio()
	{
		$cotizadorModel = new CotizadorModel();	
		$resp["data"]=$cotizadorModel->getGastoServicio($this->request->getVar('idTipoCosto'));
		return $this->respond($resp);
	}

	public function datosServicio()
	{
		$cotizadorModel = new CotizadorModel();	
		$resp["gastoServicio"]=$cotizadorModel->getGastoServicio($this->request->getVar('idTipoCosto'));
		$resp["costoServicio"]=$cotizadorModel->getCostoTurno($this->request->getVar('idTipoCosto'));
		return $this->respond($resp);
	}


}