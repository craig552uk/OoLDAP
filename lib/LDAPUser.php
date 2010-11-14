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
*   LDAP User Object
*   
*   Allows manuipulation of LDAP user objects in Oo style-ee
*
*   Example of a custom LDAP object class by extending the LDAPObject class
*   Follow the numbered steps
*/

// [1] Must include LDAPObject class
include_once('LDAPObject.php');

// [2] Define new class extending LDAPObject
class LDAPUser extends LDAPObject {

    // [3] Define constructor method
    //     Must accept an LDAPService object as parameter
    function __construct($ldapservice)
    {
        // [4] Define schema for custom object type
        //     Maps human readable names to LDAP attribute names
        //     Only defined attributes are accessible through the LDAPObject class
        //     No need to specify DN here, it is automatically included by LDAPObject
        $schema['username']     = 'uid';
        $schema['firstName']    = 'givenname';
        $schema['lastName']     = 'sn';
        $schema['fullName']     = 'displayname';
        $schema['shell']        = 'loginshell';
        $schema['home']         = 'homedirectory';
        $schema['email']        = 'mail';
        $schema['postCode']     = 'postalcode';
        $schema['location']     = 'l';
        $schema['mobilePhone']  = 'mobile';
        $schema['homePhone']    = 'homephone';
        $schema['jobTitle']     = 'title';
        $schema['address']      = 'postaladdress';
        $schema['initials']     = 'initials';

        // [5] Set the schema of this object
        $this->setSchema($schema);

        // [6] Set the LDAPService of this object
        $this->setLDAPService($ldapservice);
    }
    
    // [7] That's it!
    
    //     You can define additonal methods for your class here if you wish
    public function getFullName()
    {
        // Get Full Name
        return $this->firstName.' '.$this->lastName;
    }
}

?>
