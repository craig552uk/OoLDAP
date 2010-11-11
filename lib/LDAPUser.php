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
*   LDAP User Object
*   
*   Allows manuipulation of LDAP user objects in Oo style-ee
*/

include_once('LDAPObject.php');

class LDAPUser extends LDAPObject {

    function __construct($ldapservice)
    {
        // Schema Definition
        // Maps human readable names to LDAP attribute names
        // No need to specify DN here, it is automatically included by LDAPObject
        $schema['userName']     ='uid';
        $schema['firstName']    ='givenName';
        $schema['lastName']     ='sn';
        $schema['location']     ='l';
        $schema['entitlements'] ='entitelments';

        // Set the schema of this object
        $this->setSchema($schema);

        // Set the Directory Service of this object
        $this->setLDAPService($ldapservice);
    }

}

?>
