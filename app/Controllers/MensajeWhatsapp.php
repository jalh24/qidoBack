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
        $twilio = new Twilio();
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
            $existData = $contactoWhatsappModel->valid_send($contacto1->telefono);

            $contactos = [
                'nombre'  => $contacto1->nombre,
                'numero'  => $contacto1->telefono,
                'fechaEnvio' =>date('Y-m-d H:m:s'),
                'idMensaje'=>$mensajeWhatsapp,
                'estatus' => 0,
                'updated' => null
            ];
            
            $contactoWhatsappModel->insert_data($contactos);
            
            if($existData[0]->exist > 0){
              $resp = $twilio->sendmessage('+521'.$contacto1->telefono, null, $dataMensajeWhatsapp->mensaje . '

Si esta propuesta de trabajo le es de interés, favor de contestar en el siguiente link de Whatsapp con su Nombre, Apellido y el Número de Servicio que aparece al inicio de la propuesta: 

*Reclutamiento:*
https://api.whatsapp.com/send/?phone=5218132821007&app_absent=0&text=Si%20me%20interesa%20el%20servicio,%20mi%20nombre%20es');

            } else{
              $resp = $twilio->sendFirstMessage('+521'.$contacto1->telefono);
            }
          
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


    public function reciveMessage(){
      $twilio = new Twilio();
      $contactoWhatsappModel = new ContactoWhatsappModel();
        $json = file_get_contents('php://input');
        

        $urlWhatsapp = 'https://api.whatsapp.com/send/?phone=5218132821007';
        $number = substr($this->request->getPost('WaId'),3);
        $existData = $contactoWhatsappModel->find_number($number);
        $text ='';

        if(!empty($existData) && strpos(strtoupper($this->request->getPost('Body')),'SI') !== false){
          $text =$existData[0]->mensaje . '

Si esta propuesta de trabajo le es de interés, favor de contestar en el siguiente link de Whatsapp con su Nombre, Apellido y el Número de Servicio que aparece al inicio de la propuesta: 

' . $urlWhatsapp . '&app_absent=0&text=Si%20me%20interesa%20el%20servicio,%20mi%20nombre%20es';
          /*$resp = $twilio->sendmessage('+521'.$number, null, $existData[0]->mensaje . '

Si esta propuesta de trabajo le es de interés, favor de contestar en el siguiente link de Whatsapp con su Nombre, Apellido y el Número de Servicio que aparece al inicio de la propuesta: 

'.$urlWhatsapp.'&app_absent=0&text=Si%20me%20interesa%20el%20servicio%20121,%20mi%20nombre%20es');*/
        $data = ['estatus'=>1, 'updated'=>date('Y-m-d H:m:s')];
        $contactoWhatsappModel->update_data($number,$data);

        } 
        else {
          if(strpos(strtoupper($this->request->getPost('Body')),'NO') !== false ){
            $text ='Gracias por su pronta respuesta, nos mantendremos en contacto para futuros servicios';
          } else{
            $text ='Usted se está comunicando con un asistente virtual, si desea hablar con una persona, favor de comunicarse al siguiente número: 

*Ventas de Servicio*:
https://api.whatsapp.com/send/?phone=5218186866787

*Reclutamiento*:
https://api.whatsapp.com/send/?phone=5218132821007
' ;  
          }
          

        }

        $resp = $twilio->sendmessage('+521'.$number, null, $text);

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => $text
          ]
      ];

    }

    public function recibirMensaje(){

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Hola'
          ]
      ];

      return $this->respond($response);
    }

}
