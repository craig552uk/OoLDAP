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
*   Main LDAPObject Class
*
*   Core methods for manipulating PHP Objects.
*   Classes that extend this class must do so correctly,
*   please see the example class LDAPUser for correct implementation
*
*/

class LDAPObject {

    private $_ldap_service;
    private $_schema = array();
    private $_data = array();

    /**
    *   Define the schema for the object
    *   
    *   @param  array   $schema
    *   @return void
    */
    public function setSchema($schema)
    {
        $this->_schema       = $schema;
        $this->_schema['DN'] ='dn';         // Defined for all object types
    }

    /**
    *   Set the LDAP Service object
    *   
    *   @param  object  $ldap_service
    *   @return void
    */
    public function setLDAPService($ldap_service)
    {
        $this->_ldap_service = $ldap_service;
    }

    /**
    *   Define the data for the object
    *   
    *   @param  array   $data
    *   @return void
    */
    public function setData($data)
    {
        $this->_data = $data;        
    }

    /**
    *   Get the value of the attribute defined in the schema as $value
    *   
    *   @param  array   $obj_schema
    *   @return various
    */
    public function __get($name)
    {
        if (array_key_exists($this->_schema[$name], $this->_data)) {
            return $this->_data[$this->_schema[$name]];
        }
        
        LDAPObject::__get($name);
    }

    /**
    *   Set the attribute defined in the schema as $name to $value
    *   
    *   @param  string  $name
    *   @param  array   $value
    *   @return void
    */
    public function __set($name, $value) {
        if (array_key_exists($name, $this->_schema)) {
            $this->_data[$this->_schema[$name]] = $value;
        }
    }

    /**
    *   Echo the object $_data and $_schema
    *   
    *   @return void
    */
    public function dump()
    {
        echo "<pre>\$_data ";
        print_r($this->_data);
        echo "\$_schema ";
        print_r($this->_schema);
        echo "</pre>";
    }

    /**
    *   Save $_data to an object on $_ldap_service
    *   The object 'dn' must be specified
    *
    *   Values stored in $_data will overwrite those stored in the LDAP object
    *   If the object does not exist it will be created
    *   
    *   @return boolean
    */
    public function save()
    {
        return $this->_ldap_service->save($this->_data);
    }

}
?>
