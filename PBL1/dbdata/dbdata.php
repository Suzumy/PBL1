<?php

    //データベース接続
    class DbData{
        protected $pdo;
        
        public function __construct()
        {
            $dsn = 'mysql:host=localhost:3306;dbname=PBL1;charset=utf8';

            $user = 'root';
            $password = 'root';

            try{                      
                $this->pdo = new PDO($dsn, $user, $password);                     
            } catch(Exception  $e){                     
                echo 'Error:' . $e->getMessage( );                      
                die( );                     
            }
        }

        protected function query ( $sql,  $array_params ) {  // SELECT文実行用のメソッド
            $stmt = $this->pdo->prepare( $sql );                      
            $stmt->execute( $array_params );                      
            return  $stmt;          // PDOステートメントオブジェクトを返すのでfetch( )、fetchAll( )で結果セットを取得           
        }                     
                        
        protected function exec ( $sql,  $array_params ) {  // INSERT、UPDATE、DELETE文実行用のメソッド
            $stmt = $this->pdo->prepare( $sql );                      
            return  $stmt->execute( $array_params );        // 成功：true、失敗：false
        }
    } 