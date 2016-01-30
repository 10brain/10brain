<?php
//******************************************************************************
//* init.php 各設定ファイル
//* 20160105@ito
//*
//*
//*
//*
//******************************************************************************
define('DBname', '10brain');//DB名
define('DBhost', 'localhost');//DBhost設定
define('DBuser', 'root');//DBuser設定
define('DBpass', 'root');//DBパスワード

//PDO,DSN設定
define('DSN', "'mysql:host=' .DBhost. ';dbname=' .DBname. ';dbpass=' .DBpass. ';charset=utf8'");


/**DB接続クラス**/
class DBModel{
    protected $pdo;
    public function __construct() {
        $this->db_connect();        
    }
    
    
    //DB接続
    private function db_connect(){
        try{
            $this->pdo = new PDO(DSN);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $Exception) {
            die('エラー文:' .$Exception->getMessage());
        }
        $pdo = null;
    }
    
}

?>