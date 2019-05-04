<?php
  
// constantes com as credenciais de acesso ao banco MySQL
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_NAME', 'vidasesaude');
  
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
date_default_timezone_set('America/Sao_Paulo');
  
// inclui o arquivo de funçõees
require_once 'functions.php';