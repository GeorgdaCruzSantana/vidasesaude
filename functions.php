<?php
  
/**
 * Conecta com o MySQL usando PDO
 */
class Conexao {
    function getConexao(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vidasesaude";

        ini_set('default_charset','UTF-8');
        // Create connection
        $conn = new mysqli($servername, $username, $password,$dbname);   +
        
        $conn->query("SET NAMES utf8");
        
        
        // Check connection
        if ($conn->connect_error) {
            die("A conexÃ£o falhou: " . $conn->connect_error);
        }
        
        return $conn;
    }
    
    function fecharConexao($conn){
        $conn->close();
    }
}

  ?>

