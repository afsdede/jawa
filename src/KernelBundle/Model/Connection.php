<?php

namespace KernelBundle\Model;

/**
 * Description of Connection
 *
 * @author andre
 */
class Connection {

    public function connect() {


        if ($_SERVER['SERVER_ADDR'] == "127.0.0.1") {
            $dataBase = "jawa";
            $host = "localhost";
            $user = "root";
            $pass = "";
        } else {
            $dataBase = "jawa";
            $host = "mysql.jawa.com.br";
            $user = "root";
            $pass = "";
        }

        $conn = mysql_connect($host, $user, $pass);

        $db_selected = mysql_select_db($dataBase, $conn);
        
    }

}

?>
