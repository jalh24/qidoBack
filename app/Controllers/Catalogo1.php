<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Catalogo extends BaseController
{

	use ResponseTrait;

	public function index()
	{
		
		$zonasLaborales=(object) array('id' => '1','nombre' => 'Cumbres');
		//return view('welcome_message',$colaboradores);
        $resp["data"]=$zonasLaborales;
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

	public function teces()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$teces=(object) array('id' => '1','nombre' => 'Negra');
		$teces1=(object) array('id' => '2','nombre' => 'Morena');
		$teces2=(object) array('id' => '3','nombre' => 'Aperlada');
		$teces3=(object) array('id' => '4','nombre' => 'Clara');
		$teces4=(object) array('id' => '5','nombre' => 'Blanca');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$teces,$teces1,$teces2,$teces3,$teces4];
		return $this->respond($resp);
	}

	public function complexiones()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$complexiones=(object) array('id' => '1','nombre' => 'Delgado');
		$complexiones1=(object) array('id' => '2','nombre' => 'Regular');
		$complexiones2=(object) array('id' => '3','nombre' => 'Robusto');
		$complexiones3=(object) array('id' => '4','nombre' => 'Obeso');
		

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$complexiones,$complexiones1,$complexiones2,$complexiones3,$complexiones4];
		return $this->respond($resp);
	}

	public function parentescos()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$parentescos=(object) array('id' => '1','nombre' => 'Familiar');
		$parentescos1=(object) array('id' => '2','nombre' => 'Amigo');
		$parentescos2=(object) array('id' => '3','nombre' => 'Conyuge');
		$parentescos3=(object) array('id' => '4','nombre' => 'Vecino');
		

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$parentescos,$parentescos1,$parentescos2,$parentescos3,$parentescos4];
		return $this->respond($resp);
	}
	public function estadosCiviles()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$estadosCiviles=(object) array('id' => '1','nombre' => 'Soltero(a)');
		$estadosCiviles1=(object) array('id' => '2','nombre' => 'Casado(a)');
		$estadosCiviles2=(object) array('id' => '3','nombre' => 'Divorciado(a)');
		$estadosCiviles3=(object) array('id' => '4','nombre' => 'Unión Libre');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$estadosCiviles,$estadosCiviles1,$estadosCiviles2,$estadosCiviles3];
		return $this->respond($resp);
	}

	public function tiposTelefono()
	{		
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$tiposTelefono=(object) array('id' => '1','nombre' => 'Casa');
		$tiposTelefono1=(object) array('id' => '2','nombre' => 'Oficina');
		$tiposTelefono2=(object) array('id' => '3','nombre' => 'Celular');
		$tiposTelefono3=(object) array('id' => '4','nombre' => 'Familiar');
		$tiposTelefono4=(object) array('id' => '5','nombre' => 'Amigo');
		$tiposTelefono5=(object) array('id' => '6','nombre' => 'Vecino');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$tiposTelefono,$tiposTelefono1,$tiposTelefono2,$tiposTelefono3,$tiposTelefono4,$tiposTelefono5];
		return $this->respond($resp);
	}

	public function tiposCliente()
	{		
		
		$tiposCliente=(object) array('id' => '1','nombre' => 'Fisica');
		$tiposCliente1=(object) array('id' => '2','nombre' => 'Moral');
		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$tiposCliente,$tiposCliente1];
		return $this->respond($resp);
	}
	public function permanencias()
	{		
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$permanencias=(object) array('id' => '1','nombre' => 'Quedada');
		$permanencias1=(object) array('id' => '2','nombre' => 'Entrada');
		$permanencias2=(object) array('id' => '3','nombre' => 'Salida');
		$permanencias3=(object) array('id' => '4','nombre' => 'Ambas');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$permanencias,$permanencias1,$permanencias2,$permanencias3];
		return $this->respond($resp);
	}

	public function zonasLaborales()
	{		
		$zonasLaborales=(object) array('id' => '1','nombre' => 'Centro');
		$zonasLaborales1=(object) array('id' => '2','nombre' => 'Cumbres');
		$zonasLaborales2=(object) array('id' => '3','nombre' => 'Zona Sur');
		$zonasLaborales3=(object) array('id' => '4','nombre' => 'Carretera Nacional');
		$zonasLaborales4=(object) array('id' => '5','nombre' => 'Zona Valle');
		$zonasLaborales5=(object) array('id' => '6','nombre' => 'Santa Catarina');
		$zonasLaborales6=(object) array('id' => '7','nombre' => 'Guadalupe');
		$zonasLaborales7=(object) array('id' => '8','nombre' => 'San Nicolás');
		$zonasLaborales8=(object) array('id' => '9','nombre' => 'Escobedo');
		$zonasLaborales9=(object) array('id' => '10','nombre' => 'Cadereyta');
		$zonasLaborales10=(object) array('id' => '11','nombre' => 'Apodaca');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$zonasLaborales,$zonasLaborales1,$zonasLaborales2,$zonasLaborales3,$zonasLaborales4,$zonasLaborales5,$zonasLaborales6,$zonasLaborales7,$zonasLaborales8,$zonasLaborales9,$zonasLaborales10];
		return $this->respond($resp);
	}

	public function paises()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');	
		$paises=(object) array('id' => '1','nombre' => 'México');
		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$paises];
		return $this->respond($resp);
	}

	public function estados()
	{	
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$estados=(object) array('id' => '1','nombre' => 'Nuevo León','idPais'=>'1');
		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$estados];
		return $this->respond($resp);
	}

	public function ciudades()
	{
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$ciudades=(object) array('id' => '1','nombre' => 'Apodaca','idEstado'=>'1');
		$ciudades1=(object) array('id' => '2','nombre' => 'Cadereyta Jiménez','idEstado'=>'1');
		$ciudades2=(object) array('id' => '3','nombre' => 'Escobedo','idEstado'=>'1');
		$ciudades3=(object) array('id' => '4','nombre' => 'García','idEstado'=>'1');
		$ciudades4=(object) array('id' => '5','nombre' => 'Guadalupe','idEstado'=>'1');
		$ciudades5=(object) array('id' => '6','nombre' => 'Juárez','idEstado'=>'1');
		$ciudades6=(object) array('id' => '7','nombre' => 'Monterrey','idEstado'=>'1');
		$ciudades7=(object) array('id' => '8','nombre' => 'Salinas Victoria','idEstado'=>'1');
		$ciudades8=(object) array('id' => '9','nombre' => 'San Nicolás de los Garza','idEstado'=>'1');
		$ciudades9=(object) array('id' => '10','nombre' => 'San Pedro Garza García','idEstado'=>'1');
		$ciudades10=(object) array('id' => '11','nombre' => 'Santa Catarina','idEstado'=>'1');
		$ciudades11=(object) array('id' => '12','nombre' => 'Santiago','idEstado'=>'1');
		$ciudades12=(object) array('id' => '13','nombre' => 'Ciénega de Flores','idEstado'=>'1');
		$ciudades13=(object) array('id' => '14','nombre' => 'General Zuazua','idEstado'=>'1');
		$ciudades14=(object) array('id' => '15','nombre' => 'Pesquería','idEstado'=>'1');

		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$ciudades,$ciudades1,$ciudades2,$ciudades3,$ciudades4,$ciudades5,$ciudades6,$ciudades7,$ciudades8,$ciudades9,$ciudades10,$ciudades11,$ciudades12,$ciudades13,$ciudades14];
		return $this->respond($resp);
	}

	public function sexo()
	{
		
		$sexo=(object) array('id' => '1','nombre' => 'Hombre');
		$sexo1=(object) array('id' => '2','nombre' => 'Mujer');
		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$sexo,$sexo1];
		return $this->respond($resp);
	}

	public function colonias()
	{		
		$default=(object) array('id' => '0','nombre' => 'Selecionar');
		$colonias=(object) array('id' => '1','nombre' => 'Centro');
		//return view('welcome_message',$colaboradores);
        $resp["data"]=[$default,$colonias];
		return $this->respond($resp);
	}

}