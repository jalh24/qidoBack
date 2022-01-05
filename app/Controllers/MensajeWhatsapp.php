<?php

namespace App\Controllers;
use App\Models\ColaboradorModel;
use App\Models\ContactoColaboradorModel;
use App\Models\CuentaColaboradorModel;
use App\Models\ExperienciaModel;
use App\Models\EstudioModel;
use App\Models\ZonaModel;
use App\Models\MensajeWhatsappModel;
use App\Models\ContactoWhatsappModel;
use App\Libraries\Twilio; // Import library
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class MensajeWhatsapp extends BaseController
{
	use ResponseTrait;

    // create
    public function create() {
        $mensajeWhatsappModel = new MensajeWhatsappModel();
        $json = file_get_contents('php://input');
        $dataMensajeWhatsapp = json_decode($json);
        $data = [
            'mensaje'  => $dataMensajeWhatsapp->mensaje,
            'fechaEnvio' =>date('Y-m-d H:m:s')
        ];

        $mensajeWhatsapp= $mensajeWhatsappModel->insert_data($data);

        // Se guardan los estudios del colaborador
        $contactoWhatsappModel = new ContactoWhatsappModel();
        $contactoWhatsappList = $dataMensajeWhatsapp->contacto;

        foreach($contactoWhatsappList as $contacto1){            
            $contactos = [
                'nombre'  => $contacto1->nombre,
                'numero'  => $contacto1->telefono,
                'fechaEnvio' =>date('Y-m-d H:m:s'),
                'idMensaje'=>$mensajeWhatsapp
            ];
            $contactoWhatsappModel->insert_data($contactos);
        }

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Mensaje enviado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }

}
