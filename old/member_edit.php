<?php

require(dirname(__FILE__)."/lib/database.php");
require(dirname(__FILE__)."/lib/helper.php");
require(dirname(__FILE__)."/lib/CRUD/member/read.php");
require(dirname(__FILE__)."/lib/CRUD/member/update.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo "<h1>NOTHING SUBMITTED ... </h1>";
} else {

    $id = $_POST['id'];
    echo "<h1>EDITMEMBER: $id </h1>";    
    $member = getMember($id); //get member table from mysql and store as php array        
    //var_dump($member);
    
    $edit_form = ''
    . '<form action=member_save.php method="post">';

    foreach ($member[0] as $key => $value)
    {
      $edit_form .= '<input type="text" value='.$value.' name='.$key.'>'
        .'<br>';
    }
    $edit_form .= '<input type="submit" value="save">'; 
    $edit_form .= '</form>';        

    echo $edit_form;
} //end else
?>
    



