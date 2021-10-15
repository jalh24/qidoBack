<?php

namespace App\Controllers;
use App\Models\ClienteModel;
use App\Models\ContactoClienteModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Cliente extends BaseController
{
	use ResponseTrait;

	public function index()
	{
        
        $json = file_get_contents('php://input');
        $dataCliente = json_decode($json);
		$clienteModel = new ClienteModel();
		$clientes = $clienteModel->getClientes();
		
		
        $resp["data"]=$clientes;
       //$resp["count"] =$clienteModel->getClientesNums($dataCliente)[0];
		return $this->respond($resp);
	}

	// create
    public function create() {
        $clienteModel = new ClienteModel();
        $json = file_get_contents('php://input');
        $dataCliente = json_decode($json);
        $data = [
            'nombre'  => $dataCliente->nombre,
            'a_paterno'  => $dataCliente->a_paterno,
            'a_materno'  => $dataCliente->a_materno,
            'fecha_nacimiento'  => $dataCliente->fecha_nacimiento,
            'rfc' => $dataCliente->rfc,
            'idPaisNacimiento'  => $dataCliente->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataCliente->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataCliente->idCiudadNacimiento,
            'calle1'  => $dataCliente->calle1,
            'calle2'  => $dataCliente->calle2,
            'noExt'  => $dataCliente->noExt,
            'noInt'  => $dataCliente->noInt,
            'idColonia'  => $dataCliente->idColonia,
            'idCiudad'  => $dataCliente->idCiudad,
            'idEstado'  => $dataCliente->idEstado,
            'idPais'  => $dataCliente->idPais,
            'codigoPostal'  => $dataCliente->codigoPostal,
            'referencia'=> $dataCliente->referencia,
            'idSexo'  => $dataCliente->idSexo,
            'imss'  => $dataCliente->imss,
            'sgmm'  => $dataCliente->sgmm,           
            'idComplexion'  => $dataCliente->idComplexion,
            'peso'  => $dataCliente->peso,
            'estatura'  => $dataCliente->estatura,
            'idEstadoCivil'  => $dataCliente->idEstadoCivil,
            'telefono'  => $dataCliente->telefono,
            'idTipoTelefono'  => $dataCliente->idTipoTelefono,
            'telefono2'  => $dataCliente->telefono2,
            'idTipoTelefono2'  => $dataCliente->idTipoTelefono2,
            'correoElectronico'  => $dataCliente->correoElectronico,           
            'nombreContacto'  => $dataCliente->nombreContacto,
            'idParentescoContacto'  => $dataCliente->idParentescoContacto,
            'telefonoContacto'  => $dataCliente->telefonoContacto,
            'correoContacto'  => $dataCliente->correoContacto,            
            'nombreContacto2'  => $dataCliente->nombreContacto2,
            'idParentescoContacto2'  => $dataCliente->idParentescoContacto2,
            'telefonoContacto2'  => $dataCliente->telefonoContacto2,
            'correoContacto2'  => $dataCliente->correoContacto2,           
            'nombreMedico'  => $dataCliente->nombreMedico,
            'especialidadesMedico'  => $dataCliente->especialidadesMedico,
            'telefonoMedico'  => $dataCliente->telefonoMedico,
            'correoMedico'  => $dataCliente->correoMedico,
            'enfermedadesActuales'  => $dataCliente->enfermedadesActuales,
            'enfermedadesRecientes'  => $dataCliente->enfermedadesRecientes,
            'cirugiasRecientes'  => $dataCliente->cirugiasRecientes,
            'accidentesRecientes'  => $dataCliente->accidentesRecientes,
            'alzheimer'  => $dataCliente->alzheimer,
            'fechaCreacion' =>date('Y-m-d H:m:s'),
            'idTipoCliente'  => $dataCliente->idTipoCliente,
        ];

        //Se crea el cliente y regresa el id para sus relaciones
        $cliente= $clienteModel->insert_data($data);
        
        

        // Se guardan los contactos del cliente
        $contactoClienteModel = new ContactoClienteModel();
        $contactosClienteList = $dataCliente->contactosCliente;

        foreach($contactosClienteList as $contacto1){            
            $contacto = [
                'idCliente'=>$cliente,
                'nombre'  => $contacto1->nombre,
                'idParentesco' =>$contacto1->parentesco,
                'telefono'  => $contacto1->telefono,
                'idTipoTelefono'  => $contacto1->tipoTelefono,
                'correoElectronico'  => $contacto1->correoElectronico
                
                
            ];
            
            $contactoClienteModel->insert_data($contacto);
        }

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Cliente creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }

    
    
}
