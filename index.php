<?php

require(dirname(__FILE__)."/lib/database.php");
require(dirname(__FILE__)."/lib/helper.php");
require(dirname(__FILE__)."/lib/CRUD/members/read.php");


//DB :: beginTransaction();
$members = getMembers(); //get member table from mysql and store as php array
//debugPrint($members);
$filter = 
[
    'contact_id'  => ['rename'=>'contact_id'], 
    'name'        => ['rename'=>'voornaam'],
    'surname'     => ['rename'=>'achternaam']
];
printAsMembersHtmlTable($members, $filter);

$button_create = '<form action=member_create.php method="post">'
. '<input type="submit" value="create">'
. '</form>';

echo $button_create;