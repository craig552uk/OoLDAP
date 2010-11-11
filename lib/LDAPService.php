<?php
/**
*   Object Oriented LDAP
*
*   @package OoLDAP
*   @author Craig Russell
*   @copyright (c) 2010 Craig Russell
*   @license MIT License http://www.opensource.org/licenses/mit-license.html
*   @version 0.1
*   @link http://www.craig-russell.co.uk
*/

/**
*   LDAP Service
*
*   Allows direct interaction with LDAP service.
*/
class LDAPService {

    /*
    *   Define your LDAP server connection information here
    *
    *   server      Array of LDAP server IPs or hostnames
    *   binduser    DN of user for LDAP bind
    *   bindpass    Password of bind user
    *   bindbase    Restrict activity to subtree of this container
    */
    private $_info['server']        = array('a.a.a.a','b.b.b.b','c.c.c.c');
    private $_info['binduser']      = 'cn=admin,o=org';
    private $_info['bindpass']      = 'passw0rd';
    private $_info['bindbase']      = 'ou=people,o=org';
        
    private $_conn; // Connection string

    /**
    *   Define the schema for the object
    *   
    *   @param  array   $obj_schema
    *   @return void
    */
    public function __construct()
    {
    	// Connect to LDAP server
    }

	public function __destruct()
    {
        // Disconnect from LDAP Server
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
