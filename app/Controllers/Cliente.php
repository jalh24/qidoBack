<?php

namespace App\Controllers;
use App\Models\ClienteModel;
use App\Models\ContactoClienteModel;
use App\Models\UsuariofacturacionModel;
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
        // var_dump($dataCliente->usuariofacturacion->nombre);
        if($dataCliente->cliente->clienteExistente == false) {

        
        // Se guardan los contactos del cliente
        $usuariofacturacionModel = new UsuariofacturacionModel();
        // $contactosClienteList = $dataCliente->contactosCliente;

        $dataUsuarioFacturacion = [
            // 'idCliente'=>$cliente,
            'nombre'  => $dataCliente->usuariofacturacion->nombre,
            'a_paterno'  => $dataCliente->usuariofacturacion->a_paterno,
            'a_materno'  => $dataCliente->usuariofacturacion->a_materno,
            'telefono'  => $dataCliente->usuariofacturacion->telefono,
            'correoElectronico'  => $dataCliente->usuariofacturacion->correoElectronico, 
            'calle1'  => $dataCliente->usuariofacturacion->calle1,
            'calle2'  => $dataCliente->usuariofacturacion->calle2,
            'noExt'  => $dataCliente->usuariofacturacion->noExt,
            'noInt'  => $dataCliente->usuariofacturacion->noInt,
            'codigoPostal'  => $dataCliente->usuariofacturacion->codigoPostal,
            'idColonia'  => $dataCliente->usuariofacturacion->idColonia,
            'idCiudad'  => $dataCliente->usuariofacturacion->idCiudad,
            'idEstado'  => $dataCliente->usuariofacturacion->idEstado,
            'idPais'  => $dataCliente->usuariofacturacion->idPais,
            'idBanco' => $dataCliente->usuariofacturacion->idBanco,
            'tipoCuenta' => $dataCliente->usuariofacturacion->tipoCuenta,
            'numeroCuenta' => $dataCliente->usuariofacturacion->numeroCuenta    
         ];
         $usuarioFacturacion = $usuariofacturacionModel->insert_data($dataUsuarioFacturacion);
         
        $data = [
            'nombre'  => $dataCliente->cliente->nombre,
            'a_paterno'  => $dataCliente->cliente->a_paterno,
            'a_materno'  => $dataCliente->cliente->a_materno,
            'fecha_nacimiento'  => $dataCliente->cliente->fecha_nacimiento,
            'rfc' => $dataCliente->cliente->rfc,
            'idPaisNacimiento'  => $dataCliente->cliente->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataCliente->cliente->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataCliente->cliente->idCiudadNacimiento,
            'calle1'  => $dataCliente->cliente->calle1,
            'calle2'  => $dataCliente->cliente->calle2,
            'noExt'  => $dataCliente->cliente->noExt,
            'noInt'  => $dataCliente->cliente->noInt,
            'idColonia'  => $dataCliente->cliente->idColonia,
            'idCiudad'  => $dataCliente->cliente->idCiudad,
            'idEstado'  => $dataCliente->cliente->idEstado,
            'idPais'  => $dataCliente->cliente->idPais,
            'codigoPostal'  => $dataCliente->cliente->codigoPostal,
            'referencia'=> $dataCliente->cliente->referencia,
            'idSexo'  => $dataCliente->cliente->idSexo,    
            'sgmm'  => $dataCliente->cliente->sgmm,           
            'idComplexion'  => $dataCliente->cliente->idComplexion,
            'peso'  => $dataCliente->cliente->peso,
            'estatura'  => $dataCliente->cliente->estatura,
            'idEstadoCivil'  => $dataCliente->cliente->idEstadoCivil,
            'imss'  => $dataCliente->cliente->imss,
            'telefono'  => $dataCliente->cliente->telefono,
            'idTipoTelefono'  => $dataCliente->cliente->idTipoTelefono,
            'telefono2'  => $dataCliente->cliente->telefono2,
            'idTipoTelefono2'  => $dataCliente->cliente->idTipoTelefono2,
            'correoElectronico'  => $dataCliente->cliente->correoElectronico,           
            'nombreContacto'  => $dataCliente->cliente->nombreContacto,
            'idParentescoContacto'  => $dataCliente->cliente->idParentescoContacto,
            'telefonoContacto'  => $dataCliente->cliente->telefonoContacto,
            'correoContacto'  => $dataCliente->cliente->correoContacto,            
            'nombreContacto2'  => $dataCliente->cliente->nombreContacto2,
            'idParentescoContacto2'  => $dataCliente->cliente->idParentescoContacto2,
            'telefonoContacto2'  => $dataCliente->cliente->telefonoContacto2,
            'correoContacto2'  => $dataCliente->cliente->correoContacto2,           
            'nombreMedico'  => $dataCliente->cliente->nombreMedico,
            'especialidadesMedico'  => $dataCliente->cliente->especialidadesMedico,
            'telefonoMedico'  => $dataCliente->cliente->telefonoMedico,
            'correoMedico'  => $dataCliente->cliente->correoMedico,
            'enfermedadesActuales'  => $dataCliente->cliente->enfermedadesActuales,
            'enfermedadesRecientes'  => $dataCliente->cliente->enfermedadesRecientes,
            'cirugiasRecientes'  => $dataCliente->cliente->cirugiasRecientes,
            'accidentesRecientes'  => $dataCliente->cliente->accidentesRecientes,
            'alzheimer'  => $dataCliente->cliente->alzheimer,
            'fechaCreacion' =>date('Y-m-d H:m:s'),
            'idTipoCliente'  => $dataCliente->cliente->idTipoCliente,
            'idUsuarioFacturacion' => $usuarioFacturacion,
        ];

        //Se crea el cliente y regresa el id para sus relaciones
        $cliente= $clienteModel->insert_data($data);
    }
    if($dataCliente->cliente->clienteExistente == true) {
        $data = [
            'nombre'  => $dataCliente->cliente->nombre,
            'a_paterno'  => $dataCliente->cliente->a_paterno,
            'a_materno'  => $dataCliente->cliente->a_materno,
            'fecha_nacimiento'  => $dataCliente->cliente->fecha_nacimiento,
            'rfc' => $dataCliente->cliente->rfc,
            'idPaisNacimiento'  => $dataCliente->cliente->idPaisNacimiento,
            'idEstadoNacimiento'  => $dataCliente->cliente->idEstadoNacimiento,
            'idCiudadNacimiento'  => $dataCliente->cliente->idCiudadNacimiento,
            'calle1'  => $dataCliente->cliente->calle1,
            'calle2'  => $dataCliente->cliente->calle2,
            'noExt'  => $dataCliente->cliente->noExt,
            'noInt'  => $dataCliente->cliente->noInt,
            'idColonia'  => $dataCliente->cliente->idColonia,
            'idCiudad'  => $dataCliente->cliente->idCiudad,
            'idEstado'  => $dataCliente->cliente->idEstado,
            'idPais'  => $dataCliente->cliente->idPais,
            'codigoPostal'  => $dataCliente->cliente->codigoPostal,
            'referencia'=> $dataCliente->cliente->referencia,
            'idSexo'  => $dataCliente->cliente->idSexo,    
            'sgmm'  => $dataCliente->cliente->sgmm,           
            'idComplexion'  => $dataCliente->cliente->idComplexion,
            'peso'  => $dataCliente->cliente->peso,
            'estatura'  => $dataCliente->cliente->estatura,
            'idEstadoCivil'  => $dataCliente->cliente->idEstadoCivil,
            'imss'  => $dataCliente->cliente->imss,
            'telefono'  => $dataCliente->cliente->telefono,
            'idTipoTelefono'  => $dataCliente->cliente->idTipoTelefono,
            'telefono2'  => $dataCliente->cliente->telefono2,
            'idTipoTelefono2'  => $dataCliente->cliente->idTipoTelefono2,
            'correoElectronico'  => $dataCliente->cliente->correoElectronico,           
            'nombreContacto'  => $dataCliente->cliente->nombreContacto,
            'idParentescoContacto'  => $dataCliente->cliente->idParentescoContacto,
            'telefonoContacto'  => $dataCliente->cliente->telefonoContacto,
            'correoContacto'  => $dataCliente->cliente->correoContacto,            
            'nombreContacto2'  => $dataCliente->cliente->nombreContacto2,
            'idParentescoContacto2'  => $dataCliente->cliente->idParentescoContacto2,
            'telefonoContacto2'  => $dataCliente->cliente->telefonoContacto2,
            'correoContacto2'  => $dataCliente->cliente->correoContacto2,           
            'nombreMedico'  => $dataCliente->cliente->nombreMedico,
            'especialidadesMedico'  => $dataCliente->cliente->especialidadesMedico,
            'telefonoMedico'  => $dataCliente->cliente->telefonoMedico,
            'correoMedico'  => $dataCliente->cliente->correoMedico,
            'enfermedadesActuales'  => $dataCliente->cliente->enfermedadesActuales,
            'enfermedadesRecientes'  => $dataCliente->cliente->enfermedadesRecientes,
            'cirugiasRecientes'  => $dataCliente->cliente->cirugiasRecientes,
            'accidentesRecientes'  => $dataCliente->cliente->accidentesRecientes,
            'alzheimer'  => $dataCliente->cliente->alzheimer,
            'fechaCreacion' =>date('Y-m-d H:m:s'),
            'idTipoCliente'  => $dataCliente->cliente->idTipoCliente,
            // 'idUsuarioFacturacion' => $usuarioFacturacion,
            'idUsuarioFacturacion' => $dataCliente->cliente->clienteExistenteSelected,
        ];

        //Se crea el cliente y regresa el id para sus relaciones
        $cliente= $clienteModel->insert_data($data);
    }
        

        // Se guardan los contactos del cliente
        $contactoClienteModel = new ContactoClienteModel();
        $contactosClienteList = $dataCliente->cliente->contactosCliente;

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

    public function updateUsuarioFacturacion($id = null){

    }

    // update
    public function update($id = null){
        $clienteModel = new ClienteModel();
        $json = file_get_contents('php://input');
        $dataCliente = json_decode($json);
        $id = $dataCliente->cliente->idCliente;
        if($dataCliente->cliente->clienteExistente == false) {

        
            // Se guardan los contactos del cliente
            $usuariofacturacionModel = new UsuariofacturacionModel();
            // $contactosClienteList = $dataCliente->contactosCliente;

            $dataUsuarioFacturacion = [
                // 'idCliente'=>$cliente,
                'nombre'  => $dataCliente->usuariofacturacion->nombre,
                'a_paterno'  => $dataCliente->usuariofacturacion->a_paterno,
                'a_materno'  => $dataCliente->usuariofacturacion->a_materno,
                'telefono'  => $dataCliente->usuariofacturacion->telefono,
                'correoElectronico'  => $dataCliente->usuariofacturacion->correoElectronico, 
                'calle1'  => empty($dataCliente->usuariofacturacion->calle1) ? "" : $dataCliente->usuariofacturacion->calle1,
                'calle2'  => empty($dataCliente->usuariofacturacion->calle2) ? "" : $dataCliente->usuariofacturacion->calle2,
                'noExt'  => empty($dataCliente->usuariofacturacion->noExt) ? "" : $dataCliente->usuariofacturacion->noExt,
                'noInt'  => empty($dataCliente->usuariofacturacion->noInt) ? "" : $dataCliente->usuariofacturacion->noInt,
                'codigoPostal'  => empty($dataCliente->usuariofacturacion->codigoPostal) ? "" : $dataCliente->usuariofacturacion->codigoPostal,
                'idColonia'  => empty($dataCliente->usuariofacturacion->idColonia) ? "" : $dataCliente->usuariofacturacion->idColonia,
                'idCiudad'  => empty($dataCliente->usuariofacturacion->idCiudad) ? "" : $dataCliente->usuariofacturacion->idCiudad,
                'idEstado'  => empty($dataCliente->usuariofacturacion->idEstado) ? "" : $dataCliente->usuariofacturacion->idEstado,
                'idPais'  => empty($dataCliente->usuariofacturacion->idPais) ? "" : $dataCliente->usuariofacturacion->idPais,
                'idBanco' => empty($dataCliente->usuariofacturacion->idBanco) ? "" : $dataCliente->usuariofacturacion->idBanco,
                'tipoCuenta' => empty($dataCliente->usuariofacturacion->tipoCuenta) ? "" : $dataCliente->usuariofacturacion->tipoCuenta,
                'numeroCuenta' => empty($dataCliente->usuariofacturacion->numeroCuenta) ? "" : $dataCliente->usuariofacturacion->numeroCuenta     
             ];
    
            // $dataUsuarioFacturacion = [
            //     // 'idCliente'=>$cliente,
            //     'nombre'  => $dataCliente->nombrecliente,
            //     'a_paterno'  => $dataCliente->a_paternocliente,
            //     'a_materno'  => $dataCliente->a_maternocliente,
            //     'telefono'  => $dataCliente->telefonocliente,
            //     'correoElectronico'  => $dataCliente->correoelectronicocliente, 
            //     'calle1'  => empty($dataCliente->calle1cliente) ? "" : $dataCliente->calle1cliente,
            //     'calle2'  => empty($dataCliente->calle2cliente) ? "" : $dataCliente->calle2cliente,
            //     'noExt'  => empty($dataCliente->noExtcliente) ? "" : $dataCliente->noExtcliente,
            //     'noInt'  => empty($dataCliente->noIntcliente) ? "" : $dataCliente->noIntcliente,
            //     'codigoPostal'  => empty($dataCliente->codigoPostalcliente) ? "" : $dataCliente->codigoPostalcliente,
            //     'idColonia'  => empty($dataCliente->idColoniacliente) ? "" : $dataCliente->idColoniacliente,
            //     'idCiudad'  => empty($dataCliente->idCiudadcliente) ? "" : $dataCliente->idCiudadcliente,
            //     'idEstado'  => empty($dataCliente->idEstadocliente) ? "" : $dataCliente->idEstadocliente,
            //     'idPais'  => empty($dataCliente->idPaiscliente) ? "" : $dataCliente->idPaiscliente,
            //     'idBanco' => empty($dataCliente->idBancocliente) ? "" : $dataCliente->idBancocliente,
            //     'tipoCuenta' => empty($dataCliente->tipoCuentacliente) ? "" : $dataCliente->tipoCuentacliente,
            //     'numeroCuenta' => empty($dataCliente->numerocuentacliente) ? "" : $dataCliente->numerocuentacliente    
            //  ];
             $usuarioFacturacion = $usuariofacturacionModel->insert_data($dataUsuarioFacturacion);
             
             $data = [
                'nombre'  => $dataCliente->cliente->nombre,
                'a_paterno'  => $dataCliente->cliente->a_paterno,
                'a_materno'  => $dataCliente->cliente->a_materno,
                'fecha_nacimiento'  => $dataCliente->cliente->fecha_nacimiento,
                'rfc' => $dataCliente->cliente->rfc,
                'idPaisNacimiento'  => $dataCliente->cliente->idPaisNacimiento,
                'idEstadoNacimiento'  => $dataCliente->cliente->idEstadoNacimiento,
                'idCiudadNacimiento'  => $dataCliente->cliente->idCiudadNacimiento,
                'calle1'  => $dataCliente->cliente->calle1,
                'calle2'  => $dataCliente->cliente->calle2,
                'noExt'  => $dataCliente->cliente->noExt,
                'noInt'  => $dataCliente->cliente->noInt,
                'idColonia'  => $dataCliente->cliente->idColonia,
                'idCiudad'  => $dataCliente->cliente->idCiudad,
                'idEstado'  => $dataCliente->cliente->idEstado,
                'idPais'  => $dataCliente->cliente->idPais,
                'codigoPostal'  => $dataCliente->cliente->codigoPostal,
                'referencia'=> $dataCliente->cliente->referencia,
                'idSexo'  => $dataCliente->cliente->idSexo,    
                'sgmm'  => $dataCliente->cliente->sgmm,           
                'idComplexion'  => $dataCliente->cliente->idComplexion,
                'peso'  => $dataCliente->cliente->peso,
                'estatura'  => $dataCliente->cliente->estatura,
                'idEstadoCivil'  => $dataCliente->cliente->idEstadoCivil,
                'imss'  => $dataCliente->cliente->imss,
                'telefono'  => $dataCliente->cliente->telefono,
                'idTipoTelefono'  => $dataCliente->cliente->idTipoTelefono,
                'telefono2'  => $dataCliente->cliente->telefono2,
                'idTipoTelefono2'  => $dataCliente->cliente->idTipoTelefono2,
                'correoElectronico'  => $dataCliente->cliente->correoElectronico,           
                'nombreContacto'  => $dataCliente->cliente->nombreContacto,
                'idParentescoContacto'  => $dataCliente->cliente->idParentescoContacto,
                'telefonoContacto'  => $dataCliente->cliente->telefonoContacto,
                'correoContacto'  => $dataCliente->cliente->correoContacto,            
                'nombreContacto2'  => $dataCliente->cliente->nombreContacto2,
                'idParentescoContacto2'  => $dataCliente->cliente->idParentescoContacto2,
                'telefonoContacto2'  => $dataCliente->cliente->telefonoContacto2,
                'correoContacto2'  => $dataCliente->cliente->correoContacto2,           
                'nombreMedico'  => $dataCliente->cliente->nombreMedico,
                'especialidadesMedico'  => $dataCliente->cliente->especialidadesMedico,
                'telefonoMedico'  => $dataCliente->cliente->telefonoMedico,
                'correoMedico'  => $dataCliente->cliente->correoMedico,
                'enfermedadesActuales'  => $dataCliente->cliente->enfermedadesActuales,
                'enfermedadesRecientes'  => $dataCliente->cliente->enfermedadesRecientes,
                'cirugiasRecientes'  => $dataCliente->cliente->cirugiasRecientes,
                'accidentesRecientes'  => $dataCliente->cliente->accidentesRecientes,
                'alzheimer'  => $dataCliente->cliente->alzheimer,
                'fechaCreacion' =>date('Y-m-d H:m:s'),
                'idTipoCliente'  => $dataCliente->cliente->idTipoCliente,
                'idUsuarioFacturacion' => $usuarioFacturacion,
            ];
            // $data = [
            //     'nombre'  => $dataCliente->nombre,
            //     'a_paterno'  => $dataCliente->a_paterno,
            //     'a_materno'  => $dataCliente->a_materno,
            //     'fecha_nacimiento'  => $dataCliente->fecha_nacimiento,
            //     'rfc' => $dataCliente->rfc,
            //     'idPaisNacimiento'  => $dataCliente->idPaisNacimiento,
            //     'idEstadoNacimiento'  => $dataCliente->idEstadoNacimiento,
            //     'idCiudadNacimiento'  => $dataCliente->idCiudadNacimiento,
            //     'calle1'  => $dataCliente->calle1,
            //     'calle2'  => $dataCliente->calle2,
            //     'noExt'  => $dataCliente->noExt,
            //     'noInt'  => $dataCliente->noInt,
            //     'idColonia'  => $dataCliente->idColonia,
            //     'idCiudad'  => $dataCliente->idCiudad,
            //     'idEstado'  => $dataCliente->idEstado,
            //     'idPais'  => $dataCliente->idPais,
            //     'codigoPostal'  => $dataCliente->codigoPostal,
            //     'referencia'=> $dataCliente->referencia,
            //     'idSexo'  => $dataCliente->idSexo,    
            //     'sgmm'  => $dataCliente->sgmm,           
            //     'idComplexion'  => $dataCliente->idComplexion,
            //     'peso'  => $dataCliente->peso,
            //     'estatura'  => $dataCliente->estatura,
            //     'idEstadoCivil'  => $dataCliente->idEstadoCivil,
            //     'imss'  => $dataCliente->imss,
            //     'telefono'  => $dataCliente->telefono,
            //     'idTipoTelefono'  => $dataCliente->idTipoTelefono,
            //     'telefono2'  => $dataCliente->telefono2,
            //     'idTipoTelefono2'  => $dataCliente->idTipoTelefono2,
            //     'correoElectronico'  => $dataCliente->correoElectronico,           
            //     'nombreContacto'  => $dataCliente->nombreContacto,
            //     'idParentescoContacto'  => $dataCliente->idParentescoContacto,
            //     'telefonoContacto'  => $dataCliente->telefonoContacto,
            //     'correoContacto'  => $dataCliente->correoContacto,            
            //     'nombreContacto2'  => $dataCliente->nombreContacto2,
            //     'idParentescoContacto2'  => $dataCliente->idParentescoContacto2,
            //     'telefonoContacto2'  => $dataCliente->telefonoContacto2,
            //     'correoContacto2'  => $dataCliente->correoContacto2,           
            //     'nombreMedico'  => $dataCliente->nombreMedico,
            //     'especialidadesMedico'  => $dataCliente->especialidadesMedico,
            //     'telefonoMedico'  => $dataCliente->telefonoMedico,
            //     'correoMedico'  => $dataCliente->correoMedico,
            //     'enfermedadesActuales'  => $dataCliente->enfermedadesActuales,
            //     'enfermedadesRecientes'  => $dataCliente->enfermedadesRecientes,
            //     'cirugiasRecientes'  => $dataCliente->cirugiasRecientes,
            //     'accidentesRecientes'  => $dataCliente->accidentesRecientes,
            //     'alzheimer'  => $dataCliente->alzheimer,
            //     'fechaCreacion' =>date('Y-m-d H:m:s'),
            //     'idTipoCliente'  => $dataCliente->idTipoCliente,
            //     'idUsuarioFacturacion' => $usuarioFacturacion,
            // ];
    
            //Se crea el cliente y regresa el id para sus relaciones
            $clienteModel->update_data($id, $data);
        }

        if($dataCliente->cliente->clienteExistente == true) {
            $id1 = $dataCliente->usuariofacturacion->idUsuarioFacturacion;
             // Se guardan los contactos del cliente
             $usuariofacturacionModel = new UsuariofacturacionModel();
             // $contactosClienteList = $dataCliente->contactosCliente;
 
             $dataUsuarioFacturacion = [
                 // 'idCliente'=>$cliente,
                 'nombre'  => $dataCliente->usuariofacturacion->nombre,
                 'a_paterno'  => $dataCliente->usuariofacturacion->a_paterno,
                 'a_materno'  => $dataCliente->usuariofacturacion->a_materno,
                 'telefono'  => $dataCliente->usuariofacturacion->telefono,
                 'correoElectronico'  => $dataCliente->usuariofacturacion->correoElectronico, 
                 'calle1'  => empty($dataCliente->usuariofacturacion->calle1) ? "" : $dataCliente->usuariofacturacion->calle1,
                 'calle2'  => empty($dataCliente->usuariofacturacion->calle2) ? "" : $dataCliente->usuariofacturacion->calle2,
                 'noExt'  => empty($dataCliente->usuariofacturacion->noExt) ? "" : $dataCliente->usuariofacturacion->noExt,
                 'noInt'  => empty($dataCliente->usuariofacturacion->noInt) ? "" : $dataCliente->usuariofacturacion->noInt,
                 'codigoPostal'  => empty($dataCliente->usuariofacturacion->codigoPostal) ? "" : $dataCliente->usuariofacturacion->codigoPostal,
                 'idColonia'  => empty($dataCliente->usuariofacturacion->idColonia) ? "" : $dataCliente->usuariofacturacion->idColonia,
                 'idCiudad'  => empty($dataCliente->usuariofacturacion->idCiudad) ? "" : $dataCliente->usuariofacturacion->idCiudad,
                 'idEstado'  => empty($dataCliente->usuariofacturacion->idEstado) ? "" : $dataCliente->usuariofacturacion->idEstado,
                 'idPais'  => empty($dataCliente->usuariofacturacion->idPais) ? "" : $dataCliente->usuariofacturacion->idPais,
                 'idBanco' => empty($dataCliente->usuariofacturacion->idBanco) ? "" : $dataCliente->usuariofacturacion->idBanco,
                 'tipoCuenta' => empty($dataCliente->usuariofacturacion->tipoCuenta) ? "" : $dataCliente->usuariofacturacion->tipoCuenta,
                 'numeroCuenta' => empty($dataCliente->usuariofacturacion->numeroCuenta) ? "" : $dataCliente->usuariofacturacion->numeroCuenta     
              ];
              $usuariofacturacionModel->update_data($id1,$dataUsuarioFacturacion);

            $data = [
                'nombre'  => $dataCliente->cliente->nombre,
                'a_paterno'  => $dataCliente->cliente->a_paterno,
                'a_materno'  => $dataCliente->cliente->a_materno,
                'fecha_nacimiento'  => $dataCliente->cliente->fecha_nacimiento,
                'rfc' => $dataCliente->cliente->rfc,
                'idPaisNacimiento'  => $dataCliente->cliente->idPaisNacimiento,
                'idEstadoNacimiento'  => $dataCliente->cliente->idEstadoNacimiento,
                'idCiudadNacimiento'  => $dataCliente->cliente->idCiudadNacimiento,
                'calle1'  => $dataCliente->cliente->calle1,
                'calle2'  => $dataCliente->cliente->calle2,
                'noExt'  => $dataCliente->cliente->noExt,
                'noInt'  => $dataCliente->cliente->noInt,
                'idColonia'  => $dataCliente->cliente->idColonia,
                'idCiudad'  => $dataCliente->cliente->idCiudad,
                'idEstado'  => $dataCliente->cliente->idEstado,
                'idPais'  => $dataCliente->cliente->idPais,
                'codigoPostal'  => $dataCliente->cliente->codigoPostal,
                'referencia'=> $dataCliente->cliente->referencia,
                'idSexo'  => $dataCliente->cliente->idSexo,    
                'sgmm'  => $dataCliente->cliente->sgmm,           
                'idComplexion'  => $dataCliente->cliente->idComplexion,
                'peso'  => $dataCliente->cliente->peso,
                'estatura'  => $dataCliente->cliente->estatura,
                'idEstadoCivil'  => $dataCliente->cliente->idEstadoCivil,
                'imss'  => $dataCliente->cliente->imss,
                'telefono'  => $dataCliente->cliente->telefono,
                'idTipoTelefono'  => $dataCliente->cliente->idTipoTelefono,
                'telefono2'  => $dataCliente->cliente->telefono2,
                'idTipoTelefono2'  => $dataCliente->cliente->idTipoTelefono2,
                'correoElectronico'  => $dataCliente->cliente->correoElectronico,           
                'nombreContacto'  => $dataCliente->cliente->nombreContacto,
                'idParentescoContacto'  => $dataCliente->cliente->idParentescoContacto,
                'telefonoContacto'  => $dataCliente->cliente->telefonoContacto,
                'correoContacto'  => $dataCliente->cliente->correoContacto,            
                'nombreContacto2'  => $dataCliente->cliente->nombreContacto2,
                'idParentescoContacto2'  => $dataCliente->cliente->idParentescoContacto2,
                'telefonoContacto2'  => $dataCliente->cliente->telefonoContacto2,
                'correoContacto2'  => $dataCliente->cliente->correoContacto2,           
                'nombreMedico'  => $dataCliente->cliente->nombreMedico,
                'especialidadesMedico'  => $dataCliente->cliente->especialidadesMedico,
                'telefonoMedico'  => $dataCliente->cliente->telefonoMedico,
                'correoMedico'  => $dataCliente->cliente->correoMedico,
                'enfermedadesActuales'  => $dataCliente->cliente->enfermedadesActuales,
                'enfermedadesRecientes'  => $dataCliente->cliente->enfermedadesRecientes,
                'cirugiasRecientes'  => $dataCliente->cliente->cirugiasRecientes,
                'accidentesRecientes'  => $dataCliente->cliente->accidentesRecientes,
                'alzheimer'  => $dataCliente->cliente->alzheimer,
                'fechaCreacion' =>date('Y-m-d H:m:s'),
                'idTipoCliente'  => $dataCliente->cliente->idTipoCliente,
                'idUsuarioFacturacion' => $id1,
            ];
            $clienteModel->update_data($id, $data);
        }
        // $id = $this->request->getVar('idCliente');
        // $idUsuarioFacturacion = $this->request->getVar('idUsuarioFacturacion');
        // $data = [                      
        //     'nombre'  => $this->request->getVar('nombre'),
        //     'a_paterno'  => $this->request->getVar('a_paterno'),
        //     'a_materno'  => $this->request->getVar('a_materno'),                     
        //     'fecha_nacimiento'  => $this->request->getVar('fecha_nacimiento'),            
        //     'rfc' => $this->request->getVar('rfc'),
        //     'idPaisNacimiento'  => $this->request->getVar('idPaisNacimiento'),
        //     'idEstadoNacimiento'  => $this->request->getVar('idEstadoNacimiento'),
        //     'idCiudadNacimiento'  => $this->request->getVar('idCiudadNacimiento'),
        //     'calle1'  => $this->request->getVar('calle1'),
        //     'calle2'  => $this->request->getVar('calle2'),
        //     'noExt'  => $this->request->getVar('noExt'),
        //     'noInt'  => $this->request->getVar('noInt'),
        //     'idColonia'  => $this->request->getVar('idColonia'),
        //     'idCiudad'  => $this->request->getVar('idCiudad'),
        //     'idEstado'  => $this->request->getVar('idEstado'),
        //     'idPais'  => $this->request->getVar('idPais'),
        //     'codigoPostal'  => $this->request->getVar('codigoPostal'),          
        //     'referencia'  => $this->request->getVar('referencia'),
        //     'idSexo'  => $this->request->getVar('idSexo'),
          
        //     'sgmm'  => $this->request->getVar('sgmm'),
        //     'idComplexion'  => $this->request->getVar('idComplexion'),
        //     'peso'  => $this->request->getVar('peso'),
        //     'estatura'  => $this->request->getVar('estatura'),
        //     'idEstadoCivil'  => $this->request->getVar('idEstadoCivil'),
        //     'imss'  => $this->request->getVar('imss'), 
        //     'telefono'  => $this->request->getVar('telefono'),
        //     'idTipoTelefono'  => $this->request->getVar('idTipoTelefono'),
        //     'telefono2'  => $this->request->getVar('telefono2'),
        //     'idTipoTelefono2'  => $this->request->getVar('idTipoTelefono2'),
        //     'correoElectronico'  => $this->request->getVar('correoElectronico'),
        //     'nombreContacto'  => $this->request->getVar('nombreContacto'),
        //     'idParentescoContacto'  => $this->request->getVar('idParentescoContacto'),
        //     'telefonoContacto'  => $this->request->getVar('telefonoContacto'),
        //     'correoContacto'  => $this->request->getVar('correoContacto'),
        //     'nombreContacto2'  => $this->request->getVar('nombreContacto2'),
        //     'idParentescoContacto2'  => $this->request->getVar('idParentescoContacto2'),
        //     'telefonoContacto2'  => $this->request->getVar('telefonoContacto2'),
        //     'correoContacto2'  => $this->request->getVar('correoContacto2'),
        //     'nombreMedico'  => $this->request->getVar('nombreMedico'),
        //     'especialidadesMedico'  => $this->request->getVar('especialidadesMedico'),
        //     'telefonoMedico'  => $this->request->getVar('telefonoMedico'),
        //     'correoMedico'  => $this->request->getVar('correoMedico'),
        //     'enfermedadesActuales'  => $this->request->getVar('enfermedadesActuales'),
        //     'enfermedadesRecientes'  => $this->request->getVar('enfermedadesRecientes'),
        //     'cirugiasRecientes'  => $this->request->getVar('cirugiasRecientes'),
        //     'accidentesRecientes'  => $this->request->getVar('accidentesRecientes'),
        //     'alzheimer'  => $this->request->getVar('alzheimer'),
        //     'idTipoCliente'  => $this->request->getVar('idTipoCliente')
            
        // ];

        // $clienteModel->update_data($id, $data);
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
        if ($cliente[0]->idUsuarioFacturacion != NULL){
        $usuarioFacturacionModel = new UsuariofacturacionModel();
        $usuarioFacturacion = $usuarioFacturacionModel->selectId($cliente[0]->idUsuarioFacturacion);
        $cliente["usuarioFacturacion"] = $usuarioFacturacion[0];
    }
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
    
    public function usuariosFacturacion()
	{
        $usuarioFacturacionModel = new UsuariofacturacionModel();
        $resp["data"]=$usuarioFacturacionModel->getUsuariosFacturacion();
		return $this->respond($resp);
	}

    public function usuariosFacturacionCorreo()
	{
		$usuarioFacturacionModel = new UsuariofacturacionModel();
		$resp["data"]=$usuarioFacturacionModel->getUsuariosFacturacionCorreo($this->request->getVar('correoElectronico'));
		return $this->respond($resp);
	}
    public function usuariosFacturacionByCorreo($correo)
	{
        $usuarioFacturacionModel = new UsuariofacturacionModel();
        $resp["data"]=$usuarioFacturacionModel->getUsuariosFacturacionCorreo($correo);
		return $this->respond($resp);
	}
    public function validacionCorreo()
	{
		$usuarioFacturacionModel = new UsuariofacturacionModel();
		$resp["data"]=$usuarioFacturacionModel->getValidacionCorreo($this->request->getVar('correoElectronico'));
		return $this->respond($resp);
	}

    // public function usuariosFacturacionByCorreo($correo)
	// {
    //     $usuarioFacturacionModel = new UsuariofacturacionModel();
    //     $resp["data"]=$usuarioFacturacionModel->getUsuariosFacturacionCorreo($correo);
	// 	return $this->respond($resp);
	// }

    public function usuarioFacturacionByCorreo()
	{
		$usuarioFacturacionModel = new UsuariofacturacionModel();
		$resp["data"]=$usuarioFacturacionModel->getUsuarioFacturacionByCorreo($this->request->getVar('correoElectronico'));
		return $this->respond($resp);
	}
}
