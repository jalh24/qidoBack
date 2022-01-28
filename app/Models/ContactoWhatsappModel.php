<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class ContactoWhatsappModel extends Model
{
  protected $table = 'contactowhatsapp';
  protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
      // OR $this->db = db_connect();
  }

  public function insert_data($data = array())
  {
      $this->db->table($this->table)->insert($data);
      return $this->db->insertID();
  }

  public function valid_send($number)
  {
    
      $query = $this->db->query('SELECT count(*) exist FROM contactowhatsapp WHERE numero=\'' . $number . '\' and updated <=DATE_SUB(NOW(),INTERVAL 24 HOUR)');
      return $query->getResult();
  }

  public function find_number($number)
  {
    
      $query = $this->db->query('SELECT mw.mensaje FROM contactowhatsapp cw inner join mensajewhatsapp mw on cw.idMensaje=mw.idMensaje WHERE numero=\'' . $number . '\' and estatus=0 and updated is null');

      return $query->getResult();
  }

  public function update_data($id, $data = array())
  {
      $this->db->table($this->table)->update($data, array(
          "numero" => $id,
      ));
      return $this->db->affectedRows();
  }

}