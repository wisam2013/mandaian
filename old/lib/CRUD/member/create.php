<?php

// ==================
function createMember($arr) {

    DB :: beginTransaction();

    $id = null;
    try
    {
        $query = "CALL create_member_new(@id," 
                ." '".$arr['street1']."', "
                ." '".$arr['street2']."', "
                ." '".$arr['city']."', "
                ." '".$arr['county']."', "                
                ." '".$arr['zipcode']."', "
                ." '".$arr['email']."', "
                ." '".$arr['phone1']."', "
                ." '".$arr['phone2']."', "
                ." '".$arr['photo']."', "
                ." '".$arr['name']."', "
                ." '".$arr['surname']."', "
                ." '".$arr['occupation']."', "
                ." '".$arr['pob']."', "
                ." '".$arr['marital_status']."', "
                ." '".$arr['hobbies']."', "
                ." '".$arr['skills']."', "
                ." '".$arr['qrcode']."', "
                ." '".$arr['qrimage']."', "
                ." '".$arr['country']."' "                
                . ")";
        echo "query = $query <br>";
        $stmt = DB :: prepare ( $query ) ;
        $stmt -> execute ( ) ;
        $result = $stmt -> fetchAll();
        $id = $result[0]["member_id"];
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
    return $id;

}

