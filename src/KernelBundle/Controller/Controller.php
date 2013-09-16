<?php

namespace KernelBundle\Controller;

use KernelBundle\Model\Entity;
use KernelBundle\Model\Connection;

/**
 * Controller para controlar as ações principais do sistema
 *
 * @author afsdede
 */
class Controller {

    private $dataBase = "jawa_intranet";

    public function __construct() {

        $con = new Connection();
        $con->connect();
    }

    public function insertAction(Entity $entity) {

        $entity->assocEntity();

        $entityAr = $entity->assocEntity();

        $fields = implode("`, `", array_keys($entityAr));
        $values = implode("', '", $entityAr);

        $strQuery = "INSERT INTO `" . $this->dataBase . "`.`" . $entity->tableName() . "` (`" . $fields . "`) VALUES('" . $values . "');";

        mysql_query("SET NAMES 'utf8'");

        mysql_query($strQuery);

        return true;
    }

    public function editAction(Entity $entity) {

        if ($entity->getId() != "") {

            $entityAr = $entity->assocEntity();

            $setQuery = array();
            foreach ($entityAr as $k => $v) {
                if ($v != "") {
                    $setQuery[] = "`" . $k . "` = '" . $v . "'";
                }
            }

            $setQuery = implode($setQuery, ", ");

            $sqlQuery = "UPDATE `" . $this->dataBase . "`.`" . $entity->tableName() . "` SET $setQuery WHERE `" . $entity->primaryKey() . "` = " . $entity->getId();
            mysql_query("SET NAMES 'utf8'");
            mysql_query($sqlQuery);

            return true;
        } else {
            return false;
        }
    }

    public function deleteAction(Entity $entity) {

        if ($entity->getId() != "") {

            $sqlQuery = "DELETE FROM `" . $this->dataBase . "`.`" . $entity->tableName() . "` WHERE `" . $entity->primaryKey() . "` = " . $entity->getId();
            mysql_query($sqlQuery);

            return true;
        } else {
            return false;
        }
    }

    public function listAction(Entity $entity, $id = "", $criterio = array(), $sel = "*") {

        $whereQuery[] = (!$id) ? "1 = 1" : $entity->primaryKey() . " = " . $id;

        if (count($criterio) > 0) {
            foreach ($criterio as $kC => $vC) {
                if (is_array($vC)) {
                    $whereQuery[] = ($vC == "" || $kC == "") ? "1 = 1" : $kC . " " . $vC['operator'] . $vC['val'];
                } else {
                    $whereQuery[] = ($vC == "" || $kC == "") ? "1 = 1" : $kC . " = '" . $vC . "'";
                }
            }
        }

        $whereQuery = array_unique($whereQuery);

        $strQuery = "SELECT " . $sel . " FROM " . $entity->tableName() . " WHERE " . implode(" AND ", $whereQuery);
        $result = mysql_query($strQuery);

        $retArr = array();
        $i = 1;

        if (is_resource($result)) {
            if (mysql_num_rows($result) > 0) {

                while ($row = mysql_fetch_assoc($result)) {
                    $retArr[$i] = $row;
                    $i++;
                }
            }
        }

        return $retArr;
    }

}

?>