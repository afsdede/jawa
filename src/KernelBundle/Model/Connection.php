<?php

namespace KernelBundle\Model;

/**
 * Description of Connection
 *
 * @author andre
 */
class Connection {

    public function connect() {

        if ($_SERVER['SERVER_ADDR'] == "127.0.0.1" || "::1") {
            $dataBase = "jawa";
            $host = "localhost";
            $user = "root";
            $pass = "root";
        } else {
            $dataBase = "jawa_intranet";
            $host = "mysql.jawa.quup.com.br";
            $user = "quupjawa";
            $pass = "dk729bchj4w4";
        }

        $conn = mysql_connect($host, $user, $pass);
        if (!$conn){
            die("Erro trying to connect with database");
        }

        $db_selected = mysql_select_db($dataBase, $conn);
        
        if (!$db_selected){
            die("Error trying to select the database");
        }
        
    }

}

?>
