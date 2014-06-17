<?php
session_start();
class Conexao extends PDO {
 
    private static $instancia;
 
    public function Conexao($dbMaisLocalMaisDB, $username = "", $password = "") {
        // O construtro abaixo é o do PDO
        parent::__construct($dbMaisLocalMaisDB, $username, $password);
    }
 
    public static function conectarBanco() {
        // Se o a instancia não existe eu faço uma
        if(!isset( self::$instancia )){
            try {
                self::$instancia = new Conexao("mysql:host=localhost;dbname=bibliotecaetec", "root", "root");
            } catch ( Exception $e ) {
                echo 'Erro ao conectar';
                exit ();
            }
        }
        // Se já existe instancia na memória eu retorno ela
        return self::$instancia;
    }
}
?>
