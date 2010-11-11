<?php
/**
*   Object Oriented LDAP
*
*   @package OoLDAP
*   @author Craig Russell
*   @copyright (c) 2010 Craig Russell
*   @license xxx
*   @version 0.1
*   @link http://www.craig-russell.co.uk
*/

/**
*   LDAP Service
*
*   Allows direct interaction with LDAP service.
*/
class LDAPService {

    /**
    *   Define the schema for the object
    *   
    *   @param  array   $obj_schema
    *   @return void
    */
    public function __construct()
    {
        echo "connect";
    }

    public function search()
    {
        return $this;
    }

    public function save()
    {
        return true;
    }
    
}
?>
