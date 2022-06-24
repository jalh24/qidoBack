<?php

namespace App\Controllers;
use App\Models\BitacoraModel;
use App\Models\AsignacionColaboradorModel;
use App\Libraries\Twilio; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Bitacora extends BaseController
{
	use ResponseTrait;

    // create
    public function create() {
        $bitacoraModel = new BitacoraModel();
        $json = file_get_contents('php://input');
        $dataBitacora = json_decode($json);
        $data = [
            'desayuno'  => $dataBitacora->desayunoBitacora,
            'comida'  => $dataBitacora->comidaBitacora,
            'cena'  => $dataBitacora->cenaBitacora,
            'idEstadoAnimo' => $dataBitacora->estadoAnimoBitacora,
            'temperaturaCorporal' => $dataBitacora->temperaturaBitacora,
            'presionSistolica' => $dataBitacora->presionSistolicaBitacora,
            'presionDiastolica' => $dataBitacora->presionDiastolicaBitacora,
            'glucosa' => $dataBitacora->glucosaBitacora,
            'saturacionOxigeno' => $dataBitacora->oxigenoBitacora,
            'idServicio' => $dataBitacora->idServicioBitacora,
            'idColaborador' => $dataBitacora->idColaboradorBitacora,
            'actividad' => json_encode($dataBitacora->actividadesBitacora),
        ];

        //Se crea el colaborador y regresa el id para sus relaciones
        $idBitacora = $bitacoraModel->insert_data($data);

        // $asignacionColaboradorModel = new AsignacionColaboradorModel();
        // $asignacionColaboradorList = $dataBitacora->colaboradores;

        // foreach($asignacionColaboradorList as $colaborador1){            
        //     $colaborador = [
        //         'idBitacora'=>$idBitacora,
        //         'idColaborador'=>$colaborador1->idColaborador,
        //         'sueldo'=>$colaborador1->sueldo,
        //         'observacion'=>$colaborador1->observacion
        //     ];
            
        //     $asignacionColaboradorModel->insert_data($colaborador);
        // }

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Bitacora creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }

    public function estadosAnimo()
	{
		$bitacoraModel = new BitacoraModel();	
        $resp["data"]=$bitacoraModel->getEstadosAnimo();
		
        return $this->respond($resp);
	}

    public function actividad()
	{
		$bitacoraModel = new BitacoraModel();	
        $resp["data"]=$bitacoraModel->getActividades();
		return $this->respond($resp);
	}

    public function actividad()
	{
		$bitacoraModel = new BitacoraModel();	
        $resp["data"]=$bitacoraModel->getActividades();
		return $this->respond($resp);
	}

    public function lastBitacora()
	{
		$bitacoraModel = new BitacoraModel();
		$resp["data"]=$bitacoraModel->getLastBitacora($this->request->getVar('idServicio'));
		return $this->respond($resp);
	}
}