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

    echo "<h1>SO YOU WANT TO SAVE HUH?</h1>";    
    //echo "<h1>country = " . $_POST['country'] . "</h1>";    
    
    $arr['street1'] = $_POST['street1'];
    $arr['street2'] = $_POST['street2']; 
    $arr['city']    = $_POST['city'];
    $arr['county']  = $_POST['county'];
    $arr['zipcode'] = $_POST['zipcode'];
    $arr['email'] = $_POST['email'];
    $arr['phone1'] = $_POST['phone1'];            
    $arr['phone2'] = $_POST['phone2'];
    $arr['photo'] = $_POST['photo']; 
    $arr['name'] = $_POST['name']; 
    $arr['surname'] = $_POST['surname']; 
    $arr['occupation'] = $_POST['occupation']; 
    $arr['pob'] = $_POST['pob']; 
    $arr['marital_status'] = $_POST['marital_status']; 
    $arr['hobbies'] = $_POST['hobbies']; 
    $arr['skills'] = $_POST['skills']; 
    $arr['qrcode'] = $_POST['qrcode']; 
    $arr['qrimage'] = $_POST['qrimage'];
    $arr['country'] = $_POST['country'];            
    
    echo "IK BEN AANGEROEPEN";
    
    $member_id = createMember($arr);
    
    echo "<br>New member created = $member_id";
}
?>
    



