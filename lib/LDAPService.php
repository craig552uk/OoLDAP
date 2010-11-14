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
*
*   public __construct()
*   public __destruct()
*   public search()
*   public save()
*   public delete()
*   public authenticate()
*   private connect()
*   private cleanResult()
*
*/
class LDAPService {

    /***************************************************************************
    *   Define your LDAP server connection information here
    *
    *   ldap_server      LDAP server pool IP or domain name
    *   ldap_binduser    DN of user for LDAP bind
    *   ldap_bindpass    Password of bind user
    *   ldap_bindbase    Restrict activity to subtree of this container
    ***************************************************************************/
    private $ldap_server        = 'localhost';
    private $ldap_binduser      = 'cn=admin,dc=example,dc=com';
    private $ldap_bindpass      = 'secret';
    private $ldap_bindbase      = 'ou=people,dc=example,dc=com';
   
    private $_conn; // Connection string

    /***************************************************************************
    *   PUBLIC METHODS
    ***************************************************************************/
    
    /**
    *   Establish connection to LDAP server
    *   
    */
    public function __construct()
    {
        // TODO Add server configuration method parameters to construct
        $this->_conn = $this->connect($this->ldap_server, null, $this->ldap_binduser, $this->ldap_bindpass);
    }
    
    /**
    *   Break connection to LDAP server
    *   
    */
	public function __destruct()
    {
        // Disconnect from LDAP Server
        ldap_unbind($this->_conn);
    }

    /**
    *   Search LDAP directory with $search
    *   Return cleaned result containing $attributes
    *   Specified attributes must be LDAP attributes
    *   
    *   @param  string      $search
    *   @param  array       $schema 
    *   @return array
    */
    public function search($search, $schema = array('DN'=>'dn'))
    {
        // Perform search
        $result = ldap_search($this->_conn, $this->ldap_bindbase, $search, array_values($schema));
        
        // Return false or Cleaned Result
        if (!$result)   return false;
        else            return $this->cleanResult($result, $schema);
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
        // NOTE Only modify attributes given in $data
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
        // Get new connection to server
        $auth_conn = $this->connect($this->ldap_server, null, $this->ldap_binduser, $this->ldap_bindpass);
        if ($auth_conn)
        {
            // Search for DN of $username
            $result = $this->search("$username_attribute=$username");
        
            // For each matching user, attempt authentication
            foreach($result as $user)
            {
                // If bind successful
                if(ldap_bind($auth_conn, $user['DN'], $password))
                {
                    // Disconnect and return true
                    ldap_unbind($auth_conn);
                    return true;
                }
            }
        }
        // Disconnect and return false
        ldap_unbind($auth_conn);
        return false;
    }
    
    /***************************************************************************
    *   PRIVATE METHODS
    ***************************************************************************/
    
    /**
    *   Connects to $server on $port
    *   Authenticates as $user with $password
    *   Returns a LDAP connection resource on success
    *   or false on failure
    *   
    *   @param  string      $server
    *   @param  string      $port
    *   @param  string      $user 
    *   @param  string      $password 
    *   @return resource    
    */
    private function connect($server, $port, $user, $password)
    {
    	// Connect to LDAP server
    	$conn = ldap_connect($server) or die('Could not connect to ldap server');
    	ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    	
    	// If connection established
        if ($conn) {
            // Bind to LDAP Server
            $ldapbind = ldap_bind($conn, $user, $password) or die('Could not bind to ldap server');
            return $conn;
        }   
        return false;
    }
    
    /**
    *   Restructure LDAP search result to smaller array
    *   
    *   @param  LDAP search result   $result
    *   @return                      array
    */
    private function cleanResult($result, $schema=array('DN'=>'dn'))
    {
        $return = array();
        foreach(ldap_get_entries($this->_conn, $result) as $obj_k => $obj_v)    // Itterate Objects
        {
            if($obj_k !== 'count')
            {
                $return[$obj_k] = array();
                foreach($obj_v as $att_k => $att_v)                             // Itterate Attributes
                {
                    if(is_string($att_k) && $att_k !== 'count')                 
                    {
                        $hkey = array_search($att_k, $schema);                  // Get human readable attribute name
                        if(!is_array($att_v))
                        {
                            $return[$obj_k][$hkey] = $att_v;                   // Set non-array values
                        }else{
                            if($att_v['count'] == 1)
                            {
                                $return[$obj_k][$hkey] = $att_v[0];              // Set single-value
                            }else{
                                foreach($att_v as $val_v => $val_k)             // Itterate Multi-Values
                                {
                                    if($val_v !== 'count')
                                    {
                                        $return[$obj_k][$hkey][] = $val_k;     // Nest multi-values
                                     }
                                }
                            }
                        }
                    }
                }   
            }
        }
        return $return;
    }
}
?>
