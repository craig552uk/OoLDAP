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
    *   ldap_server      LDAP server pool IP or domain name
    *   ldap_binduser    DN of user for LDAP bind
    *   ldap_bindpass    Password of bind user
    *   ldap_bindbase    Restrict activity to subtree of this container
    */
    const ldap_server        = 'x.x.x.x';
    const ldap_binduser      = 'cn=admin,o=org';
    const ldap_bindpass      = 'passw0rd';
    const ldap_bindbase      = 'ou=people,o=org';

    /*
    *   DO NOT MAKE ANY CHANGES BELOW THIS LINE
    */
        
    private $_conn; // Connection string

    /**
    *   Establish connection to LDAP server
    *   
    */
    public function __construct()
    {
    	// Connect to LDAP server
    }

    /**
    *   Break connection to LDAP server
    *   
    */
	public function __destruct()
    {
        // Disconnect from LDAP Server
    }

    /**
    *   Search LDAP directory with $search
    *   
    *   @param  string   $search
    *   @return array
    */
    public function search($search)
    {
        return $search;
    }

    /**
    *   Save $data to LDAP directory
    *   Update object if it exists
    *   Attempt to create new object if it does not
    *   
    *   @param  array   $data
    *   @return bool
    */
    public function save($data)
    {
        return true;
    }
    
    /**
    *   Attempt to authenticate against LDAP server
    *   
    *   @param  string   $username
    *   @param  string   $password
    *   @return bool
    */
    public function authenticate($username, $password)
    {
        return true;
    }
    
}
?>
