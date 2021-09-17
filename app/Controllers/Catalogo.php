<?php

namespace App\Controllers;
use App\Models\CatalogoModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Catalogo extends BaseController
{

	use ResponseTrait;
	
	public function zonasLaborales()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getZonasLaborales();
		return $this->respond($resp);
	}

	public function paises()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getPaises();
		return $this->respond($resp);
	}

	public function estados()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getEstados($this->request->getVar('idPais'));
		return $this->respond($resp);
	}

	public function ciudades()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getCiudad($this->request->getVar('idEstado'));
		return $this->respond($resp);
	}

	public function colonias()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getColonias($this->request->getVar('idCiudad'));
		return $this->respond($resp);
	}

	public function coloniasByCodigoPostal()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getColoniasByCodigoPostal($this->request->getVar('codigoPostal'));
		return $this->respond($resp);
	}
	public function ciudadByCodigoPostal()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getCiudadesByCodigoPostal($this->request->getVar('idCiudad'));
		return $this->respond($resp);
	}
	public function estadoByCodigoPostal()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getEstadosByCodigoPostal($this->request->getVar('idEstado'));
		return $this->respond($resp);
	}

	public function sexos()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getSexo();
		return $this->respond($resp);
	}

	public function teces()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getTez();
		return $this->respond($resp);
	}

	public function comboEstadosCiviles()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getEstadoCivil();
		return $this->respond($resp);
	}

	public function estatus()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getEstatus($this->request->getVar('tipo'));
		return $this->respond($resp);
	}

	public function calificaciones()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');	
		$calificaciones=(object) array('id' => '1','nombre' => '1-Muy Malo');
		$calificaciones1=(object) array('id' => '2','nombre' => '2-Malo');
		$calificaciones2=(object) array('id' => '3','nombre' => '3-Regular');
		$calificaciones3=(object) array('id' => '4','nombre' => '4-Bueno');
		$calificaciones4=(object) array('id' => '5','nombre' => '5-Muy Bueno');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$calificaciones,$calificaciones1,$calificaciones2,$calificaciones3,$calificaciones4];
		return $this->respond($resp);
	}

	public function tiposTelefono()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');	
		$tipoTel=(object) array('id' => '1','nombre' => 'Casa');
		$tipoTel1=(object) array('id' => '2','nombre' => 'Oficina');
		$tipoTel2=(object) array('id' => '3','nombre' => 'Celular');
		$tipoTel3=(object) array('id' => '4','nombre' => 'Familiar');
		$tipoTel4=(object) array('id' => '5','nombre' => 'Amigo');
		$tipoTel5=(object) array('id' => '6','nombre' => 'Vecino');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$tipoTel,$tipoTel1,$tipoTel2,$tipoTel3,$tipoTel4,$tipoTel5];
		return $this->respond($resp);
	}

	public function permanencias()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');	
		$permanencia=(object) array('id' => '1','nombre' => 'Quedada');
		$permanencia1=(object) array('id' => '2','nombre' => 'Entrada');
		$permanencia2=(object) array('id' => '3','nombre' => 'Salida');
		$permanencia3=(object) array('id' => '4','nombre' => 'Ambas');


		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$permanencia,$permanencia1,$permanencia2,$permanencia3];
		return $this->respond($resp);
	}

}