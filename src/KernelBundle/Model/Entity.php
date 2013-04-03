<?php

namespace KernelBundle\Model;

/**
 * Interface basica para tratar as entidades
 *
 * @author andre
 */
interface Entity{
    
    /*
     * Basic in a relation with objects
     */
    public function getId();
    
    /*
     * 
     */
    
    public function primaryKey();
    
    /* 
     * Basic function to associate an entity
     * to use everywhere
     */
    public function assocEntity();
    
    /*
     * Associate a row returned by database
     * to an object
     */
    public function fetchEntity($row);
    
    /*
     * Pattern to set the table name of the entity
     */
    public function tableName();
    
}

?>