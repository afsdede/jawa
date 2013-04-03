<?php

namespace KernelBundle\Controller;

use KernelBundle\Model\Entity;

/**
 * Controller para controlar as ações principais do sistema
 *
 * @author afsdede
 */
class Controller{
    
    private $dataBase = "jawa";

    public function insertAction(Entity $entity){
        
        $entity->assocEntity();
        
        $entityAr = $entity->assocEntity();

        $fields = implode("`, `", array_keys($entityAr));
        $values = implode("', '", $entityAr);

        $strQuery = "INSERT INTO `".$this->dataBase."`.`" . $entity->tableName() . "` (`" . $fields . "`) VALUES('" . $values . "');";
        echo $strQuery;

        mysql_query($strQuery);

        return true;
        
    }
    
    public function editAction(Entity $entity){
        
        if ($entity->getId() != "") {
            
            $entityAr = $entity->assocEntity();

            $setQuery = array();
            foreach ($entityAr as $k => $v){
                if ($v != ""){
                    $setQuery[] = "`".$k."` = '".$v."'";
                }
            }

            $setQuery = implode($setQuery, ", ");

            $sqlQuery = "UPDATE `".$this->dataBase."`.`".$entity->tableName()."` SET $setQuery WHERE `".$entity->primaryKey()."` = ". $entity->getId();
            mysql_query($sqlQuery);

            return true;
        
        }else {
            return false;
        }
        
    }
    
    public function deleteAction(Entity $entity){
        
        if ($entity->getId() != "") {
            
            $sqlQuery = "DELETE FROM `".$entity->tableName()."`.`".$entity->tableName()."` WHERE `".$entity->primaryKey()."` = ". $entity->getId();
            mysql_query($sqlQuery);
            
            return true;
        }else{
            return false;
        }
        
    }
    
    public function listAction(Entity $entity, $id = ""){
        $whereQuery[] = (!$id) ? "1 = 1" : $entity->primaryKey()." = " . $id;

        $strQuery = "SELECT * FROM ".$entity->tableName()." WHERE ".implode(" AND ", $whereQuery);
        $result = mysql_query($strQuery);

        $retArr = array();
        $i = 1;

        if (mysql_num_rows($result) > 0) {

            while ($row = mysql_fetch_assoc($result)) {
                $retArr[$i] = $row;
                $i++;
            }
        }

        return $retArr;
    }
    
    
}

?>
