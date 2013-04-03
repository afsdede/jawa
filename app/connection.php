<?php

if ($_SERVER['SERVER_ADDR'] == "127.0.0.1"){ 
    $dataBase = "jawa";
    $host = "localhost";
    $user = "root";
    $pass = "";
	
}else {
    $dataBase = "jawa";
    $host = "mysql.jawa.com.br";
    $user = "root";
    $pass = "";
	
}

$conn = mysql_connect($host, $user, $pass);

if (!$conn){
    die ("Erro ao estabelecer conexão com o banco de dados! " . mysql_errno() . ": " . mysql_error());
}else {
    echo "Conexão estabelecida com sucesso!<br />";
}

$db_selected = mysql_select_db($dataBase, $conn);

if (!$db_selected){
    die ("Erro ao selecionar banco de dados!");
}else {
    echo "Banco de dados selecionado com sucesso!<br />";
}

?>