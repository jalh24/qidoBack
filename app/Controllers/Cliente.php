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
            'sgmm'  => $dataCliente->sgmm,           
            'idComplexion'  => $dataCliente->idComplexion,
            'peso'  => $dataCliente->peso,
            'estatura'  => $dataCliente->estatura,
            'idEstadoCivil'  => $dataCliente->idEstadoCivil,
            'imss'  => $dataCliente->imss,
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
                'idParentesco' =>$contacto1->parentesco->idParentesco,
                'telefono'  => $contacto1->telefonoContacto,
                'idTipoTelefono'  => $contacto1->tipoTelefono->idTipoTel,
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

    // update
    public function update($id = null){
        $clienteModel = new ClienteModel();
        $id = $this->request->getVar('idCliente');
        $data = [                      
            'nombre'  => $this->request->getVar('nombre'),
            'a_paterno'  => $this->request->getVar('a_paterno'),
            'a_materno'  => $this->request->getVar('a_materno'),                     
            'fecha_nacimiento'  => $this->request->getVar('fecha_nacimiento'),            
            'rfc' => $this->request->getVar('rfc'),
            'idPaisNacimiento'  => $this->request->getVar('idPaisNacimiento'),
            'idEstadoNacimiento'  => $this->request->getVar('idEstadoNacimiento'),
            'idCiudadNacimiento'  => $this->request->getVar('idCiudadNacimiento'),
            'calle1'  => $this->request->getVar('calle1'),
            'calle2'  => $this->request->getVar('calle2'),
            'noExt'  => $this->request->getVar('noExt'),
            'noInt'  => $this->request->getVar('noInt'),
            'idColonia'  => $this->request->getVar('idColonia'),
            'idCiudad'  => $this->request->getVar('idCiudad'),
            'idEstado'  => $this->request->getVar('idEstado'),
            'idPais'  => $this->request->getVar('idPais'),
            'codigoPostal'  => $this->request->getVar('codigoPostal'),          
            'referencia'  => $this->request->getVar('referencia'),
            'idSexo'  => $this->request->getVar('idSexo'),
          
            'sgmm'  => $this->request->getVar('sgmm'),
            'idComplexion'  => $this->request->getVar('idComplexion'),
            'peso'  => $this->request->getVar('peso'),
            'estatura'  => $this->request->getVar('estatura'),
            'idEstadoCivil'  => $this->request->getVar('idEstadoCivil'),
            'imss'  => $this->request->getVar('imss'), 
            'telefono'  => $this->request->getVar('telefono'),
            'idTipoTelefono'  => $this->request->getVar('idTipoTelefono'),
            'telefono2'  => $this->request->getVar('telefono2'),
            'idTipoTelefono2'  => $this->request->getVar('idTipoTelefono2'),
            'correoElectronico'  => $this->request->getVar('correoElectronico'),
            'nombreContacto'  => $this->request->getVar('nombreContacto'),
            'idParentescoContacto'  => $this->request->getVar('idParentescoContacto'),
            'telefonoContacto'  => $this->request->getVar('telefonoContacto'),
            'correoContacto'  => $this->request->getVar('correoContacto'),
            'nombreContacto2'  => $this->request->getVar('nombreContacto2'),
            'idParentescoContacto2'  => $this->request->getVar('idParentescoContacto2'),
            'telefonoContacto2'  => $this->request->getVar('telefonoContacto2'),
            'correoContacto2'  => $this->request->getVar('correoContacto2'),
            'nombreMedico'  => $this->request->getVar('nombreMedico'),
            'especialidadesMedico'  => $this->request->getVar('especialidadesMedico'),
            'telefonoMedico'  => $this->request->getVar('telefonoMedico'),
            'correoMedico'  => $this->request->getVar('correoMedico'),
            'enfermedadesActuales'  => $this->request->getVar('enfermedadesActuales'),
            'enfermedadesRecientes'  => $this->request->getVar('enfermedadesRecientes'),
            'cirugiasRecientes'  => $this->request->getVar('cirugiasRecientes'),
            'accidentesRecientes'  => $this->request->getVar('accidentesRecientes'),
            'alzheimer'  => $this->request->getVar('alzheimer'),
            'idTipoCliente'  => $this->request->getVar('idTipoCliente')
            
        ];

        $clienteModel->update_data($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Cliente actualizado con exito'
          ]
      ];
      return $this->respond($response);
    }

     // clienteId
     public function clienteId(){
        $clienteModel = new ClienteModel();
        $contactoClienteModel = new ContactoClienteModel();
       
        $id = $this->request->getVar('idCliente');
        $cliente=$clienteModel->getClienteId($id);
        $cliente["cuentas"] = $contactoClienteModel->getContactosCliente($id);
       

        $resp["data"] = $cliente;

        return $this->respond($resp);        
    }

    public function clientesByContacto()
	{
		$clienteModel = new ClienteModel();
		$resp["data"]=$clienteModel->getClientesByContacto($this->request->getVar('correoContacto'));
		return $this->respond($resp);
	}

    public function colaboradoresByCliente()
	{
		$clienteModel = new ClienteModel();
		$resp["data"]=$clienteModel->getColaboradoresByCliente($this->request->getVar('cliente'));
		return $this->respond($resp);
	}

    public function bitacorasByServicio()
	{
		$clienteModel = new ClienteModel();
		$resp["data"]=$clienteModel->getBitacorasByServicio($this->request->getVar('idServicio'));
		return $this->respond($resp);
	}
    
}
