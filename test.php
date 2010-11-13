<?php

include_once('lib/LDAPService.php');
include_once('lib/LDAPUser.php');

$ldapds = new LDAPService();

echo "<p>Authenticate: john passw0rd = ";
echo ($ldapds->authenticate("john","passw0rd")) ? "TRUE" : "FALSE";
echo "</p>";

echo "<pre>";
print_r($ldapds->search("uid=john", array('uid','sn','givenname')));
echo "</pre>";

/*
$b = new LDAPUser($ldapds);

$b->userName  = 'user100';
$b->DN        = 'cn=user100,ou=people,o=org';     // DN must be set for all new objects
$b->firstName = 'Indiana';
$b->lastName  = 'Jones';
$b->location  = 'The jungle';
$b->entitlements = array('FIRST', 'SECOND', 'THIRD');

$b->dump();
$b->save();

echo "<p>userName: ".$b->userName."</p>";
echo "<p>firstName: ".$b->firstName."</p>";
echo "<p>lastName: ".$b->lastName."</p>";
echo "<p>location: ".$b->location."</p>";
echo "<p>fullName: ".$b->getFullName()."</p>";
echo "<p>entitlements: "; foreach ($b->entitlements as $value) { echo $value." "; } echo "</p>";
*/


?>
