<?php
namespace App\Libraries;

require_once __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

class Twilio {
    private $twilio;
    private $number;
    public function __construct()
    {
        $this->twilio = new Client('xx', 'xx');
        $this->number ="whatsapp:+5218141700xxx";
    }

    /**
    Envio de mensajes customizados
    **/
    public function sendmessage($recipient_number, $sender_number, $message)
    {
        $result = $this->twilio->messages
                  ->create("whatsapp:".$recipient_number, // to
                           array(
                               "from" => $this->number,
                               "body" =>  $message,
                               "mediaUrl"=>["https://i0.wp.com/qido.mx/wp-content/uploads/elementor/thumbs/final-C-1-oqtordmw9wbz4gl9m92smr3inmbur0l8gwhukog03u.png"]
                           )
                  );
        $return = $this->preparereturndata($result);
        return $return;
    }

    /**
    Envios de mensajes templates de twilio
    **/
    public function sendFirstMessage($recipient_number)
    {
        $result = $this->twilio->messages
                  ->create("whatsapp:".$recipient_number, // to
                           array(
                               "from" => $this->number,
                               "body" =>  'Hola, tienes una oferta de servicio de Q.ido / Cuidadores y Enfermeras a Domicilio, si te interesa saber más responde con un *Si*'
                           )
                  );
        $return = $this->preparereturndata($result);
        return $return;
    }

    public function preparereturndata($result){
        $data = array(
            'account_sid'           => $result->accountSid,
            'api_version'           => $result->apiVersion,
            'body'                  => $result->body,
            'date_created'          => $result->dateCreated,
            'date_sent'             => $result->dateSent,
            'date_updated'          => $result->dateUpdated,
            'direction'             => $result->direction,
            'error_code'            => $result->errorCode,
            'error_message'         => $result->errorMessage,
            'from'                  => $result->from,
            'messaging_service_sid' => $result->messagingServiceSid,
            'num_media'             => $result->numMedia,
            'num_segments'          => $result->numSegments,
            'price'                 => $result->price,
            'price_unit'            => $result->priceUnit,
            'sid'                   => $result->sid,
            'status'                => $result->status,
            'subresource_uris'      => $result->subresourceUris,
            'to'                    => $result->to,
            'uri'                   => $result->uri

        );
        return  $data;
    }
}