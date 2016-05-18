<?php
require(dirname(__FILE__)."/lib/database.php");
require(dirname(__FILE__)."/lib/helper.php");
require(dirname(__FILE__)."/lib/CRUD/member/read.php");
require(dirname(__FILE__)."/lib/CRUD/member/delete.php");
require(dirname(__FILE__)."/lib/CRUD/member/update.php");

// ===========================
$id = filter_input(INPUT_GET, 'id');


$button_edit = '<form action=member_edit.php method="post">'
. '<input type="hidden" value='.$id.' name="id">'
. '<input type="submit" value="edit">'
. '</form>';




DB :: beginTransaction();
echo "<h1>VIEW MEMBER: $id </h1>";
$member = getMember($id); //get member table from mysql and store as php array
debugPrint($member);
$filter = 
[
    'id'             => ['rename'=>'id'],
    'street1'        => ['rename'=>'street1'],
    'street2'        => ['rename'=>'street2'],
    'city'           => ['rename'=>'city'],
    'county'         => ['rename'=>'province'], 
    'zipcode'        => ['rename'=>'zipcode'],
    'email'          => ['rename'=>'email'],
    'phone1'         => ['rename'=>'phone1'],
    'phone2'         => ['rename'=>'phone2'],
    'photo'          => ['rename'=>'photo'],
    'name'           => ['rename'=>'name'],
    'surname'        => ['rename'=>'achternaam'],
    'occupation'     => ['rename'=>'occupation'],
    'pob'            => ['rename'=>'place_of_birth'],
    'marital_status' => ['rename'=>'marital_status'],
    'hobbies'        => ['rename'=>'hobbies'],
    'skills'         => ['rename'=>'skills'],
    'qrcode'         => ['rename'=>'qrcode'],
    'qrimage'        => ['rename'=>'qrimage'],
    'active'         => ['rename'=>'active', 'check'=>1],
    'country'        => ['rename'=>'country'],        
];
printAsHtmlTable($member, $filter);

echo $button_edit;
?>
