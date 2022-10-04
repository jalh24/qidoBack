<?php

namespace App\Controllers;
use App\Models\BitacoraModel;
use App\Models\FotoBitacoraModel;
use App\Models\FotoVacunaBitacoraModel;
use App\Models\FotoMedicinaBitacoraModel;
use App\Models\AsignacionColaboradorModel;
use App\Models\NotificacionBitacoraTokenDispositivoModel;
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

        $fotoBitacoraModel = new FotoBitacoraModel();

        $dataFoto = [
            'idBitacora' => $idBitacora,
            'foto'  => $dataBitacora->foto,
            'fotoExt'  => $dataBitacora->fotoExt,
        ];
        
        $idBitacoraFoto = $fotoBitacoraModel->insert_data($dataFoto);

        $fotoVacunaBitacoraModel = new FotoVacunaBitacoraModel();

        $dataFotoVacuna = [
            'idBitacora' => $idBitacora,
            'foto'  => $dataBitacora->fotoVacuna,
            'fotoExt'  => $dataBitacora->fotoVacunaExt,
        ];
        
        $idBitacoraVacunaFoto = $fotoVacunaBitacoraModel->insert_data($dataFotoVacuna);

        $fotoMedicinaBitacoraModel = new FotoMedicinaBitacoraModel();

        $dataFotoMedicina = [
            'idBitacora' => $idBitacora,
            'foto'  => $dataBitacora->fotoMedicina,
            'fotoExt'  => $dataBitacora->fotoMedicinaExt,
        ];
        
        $idBitacoraMedicinaFoto = $fotoMedicinaBitacoraModel->insert_data($dataFotoMedicina);

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
              'success' => 'Bitacora creado exitosamente',
              'lastId' => $idBitacora
          ]
      ];
      return $this->respondCreated($response);
    }


    public function notificacionBitacoraTokenDispositivo() {
        $notificacionBitacoraTokenDispositivoModel = new NotificacionBitacoraTokenDispositivoModel();
        $json = file_get_contents('php://input');
        $dataNotificacionBitacoraTokenDispositivo = json_decode($json);
        $data = [
            'idBitacora'  => $dataNotificacionBitacoraTokenDispositivo->idBitacora,
            'tokenDispositivo'  => $dataNotificacionBitacoraTokenDispositivo->tokenDispositivo,
        ];

        $idNotificacionBitacoraTokenDispositivo = $notificacionBitacoraTokenDispositivoModel->insert_data($data);

        $response = [        
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Relación Bitacora Token Dispositivo creado exitosamente'
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

    // public function actividad()
	// {
	// 	$bitacoraModel = new BitacoraModel();	
    //     $resp["data"]=$bitacoraModel->getActividades();
	// 	return $this->respond($resp);
	// }

    public function lastBitacora()
	{
		$bitacoraModel = new BitacoraModel();
		$resp["data"]=$bitacoraModel->getLastBitacora($this->request->getVar('idServicio'));
		return $this->respond($resp);
	}

    public function fcmByServicio()
	{
		$bitacoraModel = new BitacoraModel();
		$resp["data"]=$bitacoraModel->getFcmByServicio($this->request->getVar('idServicio'));
		return $this->respond($resp);
	}

    public function fotoGeneralByBitacoraId()
	{
		$fotoBitacoraModel = new FotoBitacoraModel();
		$resp["data"]=$fotoBitacoraModel->getFotoGeneralByBitacoraId($this->request->getVar('idBitacora'));
		return $this->respond($resp);
	}

    public function fotoVacunaByBitacoraId()
	{
		$fotoVacunaBitacoraModel = new FotoVacunaBitacoraModel();
		$resp["data"]=$fotoVacunaBitacoraModel->getFotoVacunaByBitacoraId($this->request->getVar('idBitacora'));
		return $this->respond($resp);
	}

    public function fotoMedicinaByBitacoraId()
	{
		$fotoMedicinaBitacoraModel = new FotoMedicinaBitacoraModel();
		$resp["data"]=$fotoMedicinaBitacoraModel->getFotoMedicinaByBitacoraId($this->request->getVar('idBitacora'));
		return $this->respond($resp);
	}

    public function bitacoraById()
	{
		$bitacoraModel = new BitacoraModel();
		$resp["data"]=$bitacoraModel->getBitacoraById($this->request->getVar('idBitacora'));
		return $this->respond($resp);
	}

    public function bitacorasTokenDispositivo()
	{
		$notificacionBitacoraTokenDispositivoModel = new NotificacionBitacoraTokenDispositivoModel();	
		$resp["data"]=$notificacionBitacoraTokenDispositivoModel->getBitacorasTokenDispositivo($this->request->getVar('tokenDispositivo'));
		return $this->respond($resp);
	}
}