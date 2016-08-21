<?php

require(dirname(__FILE__)."/lib/database.php");
require(dirname(__FILE__)."/lib/helper.php");
require(dirname(__FILE__)."/lib/CRUD/member/read.php");
require(dirname(__FILE__)."/lib/CRUD/member/create.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo "<h1>NOTHING SUBMITTED ... </h1>";
} else {

    echo "<h1>CREATE NEW MEMBER</h1>";    
   
    $edit_form = '<form action=member_save.php method="post">'
    . '<input type="text" value="street1" name="street1"><br>'
    . '<input type="text" value="street2" name="street2"><br>'
    . '<input type="text" value="city" name="city"><br>'
    . '<input type="text" value="county" name="county"><br>'
    . '<input type="text" value="zipcode" name="zipcode"><br>'
    . '<input type="text" value="email" name="email"><br>'
    . '<input type="text" value="phone1" name="phone1"><br>'
    . '<input type="text" value="phone2" name="phone2"><br>'
    . '<input type="text" value="photo" name="photo"><br>'
    . '<input type="text" value="name" name="name"><br>'
    . '<input type="text" value="surname" name="surname"><br>'
    . '<input type="text" value="occupation" name="occupation"><br>'
    . '<input type="text" value="pob" name="pob"><br>'
    . '<input type="text" value="marital_status" name="marital_status"><br>'
    . '<input type="text" value="hobbies" name="hobbies"><br>'
    . '<input type="text" value="skills" name="skills"><br>'
    . '<input type="text" value="qrcode" name="qrcode"><br>'
    . '<input type="text" value="qrimage" name="qrimage"><br>'
    . '<input type="text" value="active" name="active"><br>'            
    . '<input type="text" value="country" name="country"><br>'            
    . '<input type="submit" value="save">' 
    . '</form>';        

    echo $edit_form;
} //end else
?>
    



