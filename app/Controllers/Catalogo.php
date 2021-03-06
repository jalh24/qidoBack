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

	public function clientes()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getClientes();
		return $this->respond($resp);
	}

	public function clientesById()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getClientesById($this->request->getVar('idCliente'));
		return $this->respond($resp);
	}

	public function colaboradores()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getColaboradores();
		return $this->respond($resp);
	}

	public function colaboradoresCurp()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getColaboradoresCurp();
		return $this->respond($resp);
	}

	public function servicioColaboradoresFiltro()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getServicioColaboradoresFiltro();
		return $this->respond($resp);
	}

	public function responsables()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getResponsable();
		return $this->respond($resp);
	}

	public function especialidades()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getEspecialidades();
		return $this->respond($resp);
	}

	public function habilidades()
	{
		$catalogoModel = new CatalogoModel();	
        $resp["data"]=$catalogoModel->getHabilidades();
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

	

	public function complexiones()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getComplexiones();
		return $this->respond($resp);
	}

	public function parentescos()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getParentescos();
		return $this->respond($resp);
	}

	public function estatusPago()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getEstatusPago();
		return $this->respond($resp);
	}

	public function estatusOperacion()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getEstatusOperacion();
		return $this->respond($resp);
	}


	public function bancos()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getBanco();
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
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getCalificacion();
		return $this->respond($resp);
	}

	public function gradoEstudios()
	{	
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getGradoEstudio();
		return $this->respond($resp);
	}

	public function tipoVisas()
	{	
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getTipoVisa();
		return $this->respond($resp);
	}

	public function tiposColaboradores()
	{	
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getTipoColaborador();
		return $this->respond($resp);
	}

	public function tiposTelefono()
	{	
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getTiposTelefono();
		return $this->respond($resp);
	}

	public function tipoClientes()
	{
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getTipoCliente();
		return $this->respond($resp);
	}


	public function permanencias()
	{	
		// $default=(object) array('id' => '0','nombre' => 'Selecionar');	
		// $permanencia=(object) array('id' => '1','nombre' => 'Quedada');
		// $permanencia1=(object) array('id' => '2','nombre' => 'Entrada');
		// $permanencia2=(object) array('id' => '3','nombre' => 'Salida');
		// $permanencia3=(object) array('id' => '4','nombre' => 'Ambas');


		// //return view('welcome_message',$colaboradores);
        // $resp["data"]=[$default,$permanencia,$permanencia1,$permanencia2,$permanencia3];
		// return $this->respond($resp);
		$catalogoModel = new CatalogoModel();	
		$resp["data"]=$catalogoModel->getPermanencias();
		return $this->respond($resp);
	}

}