<?php

namespace App\Controllers;
use App\Models\TokendispositivosModel;
use App\Models\AsignacionColaboradorModel;
use App\Libraries\Twilio; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Tokendispositivos extends BaseController
{
	use ResponseTrait;

    // create
    public function create() {
        $tokendispositivosModel = new TokendispositivosModel();
        $json = file_get_contents('php://input');
        $dataTokendispositivos = json_decode($json);
        $data = [
            'emailUsuario'  => $dataTokendispositivos->emailUsuario,
            'tokenDispositivo'  => $dataTokendispositivos->tokenDispositivo,
        ];

        //Se crea el colaborador y regresa el id para sus relaciones
        $idTokendispositivos = $tokendispositivosModel->insert_data($data);

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Usuario Registrado'
          ]
      ];
      return $this->respondCreated($response);
    }

    public function tokensDispositivos()
	{
		$tokendispositivosModel = new TokendispositivosModel();
		$resp["data"]=$tokendispositivosModel->getTokensDispositivos($this->request->getVar('correoElectronico'));
		return $this->respond($resp);
	}
}