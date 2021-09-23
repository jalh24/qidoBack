<?php

namespace App\Controllers;
use App\Models\ColaboradorModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Colaborador extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$colaboradorModel = new ColaboradorModel();
		$colaboradores = $colaboradorModel->getColaboradores();
		
		//return view('welcome_message',$colaboradores);
        $resp["data"]=$colaboradores;
		return $this->respond($resp);
	}

	// create
    public function create() {
        $colaboradorModel = new ColaboradorModel();

          $data = [
            'nombre'  => $this->request->getVar('nombre'),
            'a_paterno'  => $this->request->getVar('a_paterno'),
            'a_materno'  => $this->request->getVar('a_materno'),
            'correoElectronico'  => $this->request->getVar('correo_electronico'),
            'foto'  => $this->request->getVar('foto'),
            'rfc' => $this->request->getVar('rfc'),
            'nss'  => $this->request->getVar('nss'),
            'fecha_nacimiento'  => $this->request->getVar('fecha_nacimiento'),
            'idSexo'  => $this->request->getVar('idSexo'),
            'peso'  => $this->request->getVar('peso'),
            'estatura'  => $this->request->getVar('estatura'),
            'idZonaLaboral'  => $this->request->getVar('idZonaLaboral'),
            'idEstadoCivil'  => $this->request->getVar('idEstadoCivil'),
            'idTez'  => $this->request->getVar('idTez'),
            'sgmm'  => $this->request->getVar('sgmm'),
            'atiendeCovid'  => $this->request->getVar('atiendeCovid'),
            'antecedentePenales'  => $this->request->getVar('antecedentePenales'),
            'autoPropio'  => $this->request->getVar('autoPropio'),
            'dispuestoViajar'  => $this->request->getVar('dispuestoViajar'),
            'visa'  => $this->request->getVar('visa'),
            'visaNumero'  => $this->request->getVar('visaNumero'),
            'tipoVisa'  => $this->request->getVar('tipoVisa'),
            'expiracionVisa'  => $this->request->getVar('expiracionVisa'),
            'visaImagen'  => $this->request->getVar('visaImagen'),
            'pasaporte'  => $this->request->getVar('pasaporte'),
            'pasaporteNumero'  => $this->request->getVar('pasaporteNumero'),
            'expiracionPasaporte'  => $this->request->getVar('expiracionPasaporte'),
            'pasaporteImagen'  => $this->request->getVar('pasaporteImagen'),
            'ine1'  => $this->request->getVar('ine1'),
            'ine2'  => $this->request->getVar('ine2'),
            'idEstatus'  => $this->request->getVar('idEstatus'),
            'calle1'  => $this->request->getVar('calle1'),
            'calle2'  => $this->request->getVar('calle2'),
            'codigoPostal'  => $this->request->getVar('codigoPostal'),
            'idPais'  => $this->request->getVar('idPais'),
            'idEstado'  => $this->request->getVar('idEstado'),
            'idCiudad'  => $this->request->getVar('idCiudad'),
            'idColonia'  => $this->request->getVar('idColonia'),
            'noExt'  => $this->request->getVar('noExt'),
            'noInt'  => $this->request->getVar('noInt'),
            'horario'  => json_encode($this->request->getVar('horario'), JSON_FORCE_OBJECT)
        ];
        var_dump($data);
        $colaborador= $colaboradorModel->insert_data($data);

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Employee created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }

    // update
    public function update($id = null){
        $colaboradorModel = new ColaboradorModel();
        $id = $this->request->getVar('num_colaborador');
        $data = [
            'rfc' => $this->request->getVar('rfc'),
            'foto'  => $this->request->getVar('foto'),
            'nombre'  => $this->request->getVar('nombre'),
            'a_paterno'  => $this->request->getVar('a_paterno'),
            'a_materno'  => $this->request->getVar('a_materno'),
            'nss'  => $this->request->getVar('nss'),
            'ine'  => $this->request->getVar('ine'),
            'fecha_nacimiento'  => $this->request->getVar('fecha_nacimiento'),
            'ldn_ciudad'  => $this->request->getVar('ldn_ciudad'),
            'ldn_pais'  => $this->request->getVar('ldn_pais'),
            'calle1'  => $this->request->getVar('calle1'),
            'calle2'  => $this->request->getVar('calle2'),
            'no_ext'  => $this->request->getVar('no_ext'),
            'no_int'  => $this->request->getVar('no_int'),
            'colonia'  => $this->request->getVar('colonia'),
            'ciudad'  => $this->request->getVar('ciudad'),
            'estado'  => $this->request->getVar('estado'),
            'pais'  => $this->request->getVar('pais'),
            'codigo_postal'  => $this->request->getVar('codigo_postal'),
            'comprobante'  => $this->request->getVar('comprobante'),
            'sexo'  => $this->request->getVar('sexo'),
            'peso'  => $this->request->getVar('peso'),
            'tez'  => $this->request->getVar('tez'),
            'estado_civil'  => $this->request->getVar('estado_civil'),
            'telefono1'  => $this->request->getVar('telefono1'),
            'telefono1_tipo'  => $this->request->getVar('telefono1_tipo'),
            'telefono2'  => $this->request->getVar('telefono2'),
            'telefono2_tipo'  => $this->request->getVar('telefono2_tipo'),
            'correo_electronico'  => $this->request->getVar('correo_electronico'),
            'sgmm'  => $this->request->getVar('sgmm'),
            'aseguradora'  => $this->request->getVar('aseguradora'),
            'permanencia'  => $this->request->getVar('permanencia'),
            'atiende_covid'  => $this->request->getVar('atiende_covid'),
            'a_penales'  => $this->request->getVar('a_penales'),
            'disp_viajar'  => $this->request->getVar('disp_viajar'),
            'visa'  => $this->request->getVar('visa'),
            'num_visa'  => $this->request->getVar('num_visa'),
            'tipo_visa'  => $this->request->getVar('tipo_visa'),
            'fechaexp_visa'  => $this->request->getVar('fechaexp_visa'),
            'pasaporte'  => $this->request->getVar('pasaporte'),
            'num_pasaporte'  => $this->request->getVar('num_pasaporte'),
            'fechaexp_pasaporte'  => $this->request->getVar('fechaexp_pasaporte'),
            'referencia'  => $this->request->getVar('referencia'),
            'estatura'  => $this->request->getVar('estatura'),
            'contacto1'  => $this->request->getVar('contacto1'),
            'parentesco_con1'  => $this->request->getVar('parentesco_con1'),
            'telefono_con1'  => $this->request->getVar('telefono_con1'),
            'correo_con1'  => $this->request->getVar('correo_con1'),
            'contacto2'  => $this->request->getVar('contacto2'),
            'parentesco_con2'  => $this->request->getVar('parentesco_con2'),
            'telefono_con2'  => $this->request->getVar('telefono_con2'),
            'correo_con2'  => $this->request->getVar('correo_con2'),
            'zona_laboral'  => $this->request->getVar('zona_laboral'),
            'auto_propio'  => $this->request->getVar('auto_propio')
        ];

        $colaboradorModel->update_data($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Employee updated successfully'
          ]
      ];
      return $this->respond($response);
    }

    // delete
    public function delete($id = null){
        $colaboradorModel = new ColaboradorModel();
        $id = $this->request->getVar('num_colaborador');
                    $colaboradorModel->delete_data($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        
    }

}
