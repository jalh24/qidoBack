<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class MensajeWhatsappModel extends Model
{
  protected $table = 'mensajewhatsapp';
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

}