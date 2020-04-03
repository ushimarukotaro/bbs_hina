<?php

namespace Bbs;

class Model {

  protected $db;
  public function __construct() {
    //Modeクラス及び小クラスのインスタンスを生成した際には、必ずPODクラスのインスタンスを生成する
    try {
      $this->db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
}