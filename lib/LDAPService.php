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
    const ldap_server        = 'ldap.openldap.org';
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
    	//NOTE Temporarily disabled bind function
    	//$_conn = ldap_connect('ldap_server') or die('Could not connect to ldap server');
    	
    	// If connection established
        if ($_conn) {
            // Bind to LDAP Server
            $ldapbind = ldap_bind($_conn, 'ldap_binduser', 'ldap_bindpass') or die('Could not bind to ldap server');
        }
    }

    /**
    *   Break connection to LDAP server
    *   
    */
	public function __destruct()
    {
        // Disconnect from LDAP Server
        ldap_unbind($_conn);
    }

    /**
    *   Search LDAP directory with $search
    *   
    *   @param  string   $search
    *   @return array
    */
    public function search($search, $attributes = array())
    {
        // TODO Perform search
        // TODO Restructure search results in to nested array
        return array();
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
        // TODO Build LDIF data structure from $data
        // NOTE Delete empty valued attributes
        // NOTE Only modify attributes specified in $data
        // TODO Apply LDIF to LDAP Directory
        return true;
    }
   
    /**
    *   Delete object(s) in $data to LDAP directory if it exists
    *   
    *   @param  array   $data
    *   @return bool
    */
    public function delete($data)
    {
        // TODO Extract DN from $data
        // TODO Delete object from LDAP server if it exists
        return true;
    }
     
    /**
    *   Attempt to authenticate against LDAP server
    *   Authentication will be tried against all accounts with $username
    *   
    *   @param  string   $username
    *   @param  string   $password
    *   @param  string   $username_attribute
    *   @return bool
    */
    public function authenticate($username, $password, $username_attribute='uid')
    {
        // TODO Search for DN of $username
        // TODO Attempt authentication with DN and $password for each result
        return true;
    }
    
}
?>
