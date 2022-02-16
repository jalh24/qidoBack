<?php

namespace App\Controllers;
use App\Models\PagoModel;
use App\Models\ServicioModel;
use App\Libraries\Twilio; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Pago extends BaseController
{
	use ResponseTrait;

    public function index()
	{
        
        $json = file_get_contents('php://input');
        $dataPago = json_decode($json);
		$pagoModel = new PagoModel();
		$pagos = $pagoModel->getPagos($dataPago);
		
		
        $resp["data"]=$pagos;
        $resp["count"] =$pagoModel->getPagosNums($dataPago)[0];
		return $this->respond($resp);
	}
    // create
    public function create() {
        $pagoModel = new PagoModel();
        $json = file_get_contents('php://input');
        $dataPago = json_decode($json);
        $data = [
            'idServicio'  => $dataPago->idServicio,
            'monto'  => $dataPago->monto,
            'motivo'  => $dataPago->motivo,
            'fechaPago' =>date('Y-m-d H:m:s'),
            'estatusPago' => $dataPago->estatusPago,
        ];

        //Se crea el colaborador y regresa el id para sus relaciones
        $idPagoServicio= $pagoModel->insert_data($data);

        // $asignacionColaboradorModel = new AsignacionColaboradorModel();
        // $asignacionColaboradorList = $dataPago->colaboradores;

        // foreach($asignacionColaboradorList as $colaborador1){            
        //     $colaborador = [
        //         'idServicio'=>$idServicio,
        //         'idColaborador'=>$colaborador1->idColaborador
        //     ];
            
        //     $asignacionColaboradorModel->insert_data($colaborador);
        // }

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Servicio creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }

}