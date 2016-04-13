<?php
//******************************************************************************
//* init.php 各設定ファイル
//* 20160105@ito
//*
//*
//*
//*
//******************************************************************************
define('DSN', 'mysql:host=localhost; dbname=10brain; charset=utf8');
define('DBuser', 'root');//DBuser設定
define('DBpass', '10btnDB');//DBパスワード

/**DB接続クラス**/
class DBModel{
    public $pdo;
    
    public function __construct() {
        $this->db_connect();        
    }
    
    //DB接続
    private function db_connect(){
        try{
            $this->pdo = new PDO(DSN, DBuser, DBpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $pdo = null;
        } catch (Exception $Exception) {
            die('エラー文:' .$Exception->getMessage());
        }
        
    }
    
}

?>