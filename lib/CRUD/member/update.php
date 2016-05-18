<?php

// ==================
function updateMember($arr) {
    DB :: beginTransaction();
    /*
    $contact_street1 = $arr['street1'];
    $contact_street2 = $arr['street2']; 
    $contact_city =  $arr['city'];
    $contact_county =  $arr['county'];
    $contact_zipcode = $arr['zipcode'];             
    $contact_email =  $arr['email'];            
    $contact_phone1 =  $arr['phone1'];            
    $contact_phone2 =  $arr['phone2'];            
    $contact_info_photo     =  $arr['photo']; 
    $contact_info_name      =  $arr['name']; 
    $contact_info_surname   =  $arr['surname']; 
    $contact_info_occupation=  $arr['occupation']; 
    $contact_info_pob       =  $arr['pob']; 
    $contact_info_martial_status =  $arr['marital_status']; 
    $contact_info_hobbies   =  $arr['hobbies']; 
    $contact_info_skills    =  $arr['skills']; 
    $contact_info_qrcode    =  $arr['qrcode']; 
    $contact_info_qrimage   =  $arr['qrimage']; 

    $id = null;
    try
    {
        $query = "CALL create_member_new(@id, 'Sesamestreet', 'bla', 'Rotterdam', 'Zuid-Holland', '3038BR', 'bla@bla.com', '0642109063', '0104578942', 'photo', 'Michiel', 'Pleijte', 'idioot', 'Goes', 'single', 'chips eten', 'nothing', 'qrcode1', 'qrimage1')";
        $stmt = DB :: prepare ( $query ) ;
        $stmt -> execute ( ) ;
        //$allMembers = $stmt -> fetchAll();
        $id = $stmt -> fetchAll();
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'Performing rollback';
        DB :: rollback();
        exit;
    } finally 
    {
        $stmt -> closeCursor () ;
    }
     * 
     */
    return 1;

}


