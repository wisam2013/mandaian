<?php

require(dirname(__FILE__)."/lib/database.php");
require(dirname(__FILE__)."/lib/helper.php");



function getMember($id) {
    $allMembers = null;
    try
    {
        $query = "CALL read_member($id);";
        $stmt = DB :: prepare ( $query ) ;
        $stmt -> execute ( ) ;
        $allMembers = $stmt -> fetchAll();
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

    /*
    $arr = [];
    foreach ($allMembers as $key => $val)
    {
        if (isset($val)) //check if this is ok
        {
            //$a = ['id'=>$val['id'], 'name'=>$val['name'], 'surname'=>$val['surname']];
            //array_push($arr, new DBS_Members($a));
        }
    }
    */
    return $allMembers;

}

function getMembers() {
    $allMembers = null;
    //DB :: beginTransaction();
    try
    {
        $query = "CALL read_members";
        $stmt = DB :: prepare ( $query ) ;
        $stmt -> execute ( ) ;
        $allMembers = $stmt -> fetchAll();
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
    //DB :: endTransaction();
    return $allMembers;

}

// $table : php array from function such as getMember
// $filter : rename actual table names when printing it to html table
// e.g.
//     $filter = 
//     [
//        'id'             => ['rename'=>'id'], 
//        'surname'        => ['rename'=>'achternaam'],
//        'occupation'     => ['rename'=>'beroep'],
//        'active'         => ['rename'=>'active', 'check'=>1]
//     ];
function printAsHtmlTable($table, $filter){

    $members_filtered = getFilteredArray($table, $filter);

    $table_str = "<table table border='1' cellspacing='1'>"; 
    $table_str .= getKeysAsTableCols($members_filtered);
    $table_str .= getValsAsTableRows($members_filtered);
    $table_str .= "</table>";

    echo $table_str;    
}



// ===========================
DB :: beginTransaction();
echo "<h1>Hello World</h1>";
$member = getMember(26); //get member table from mysql and store as php array
//debugPrint($member);
$filter = 
[
    'id'             => ['rename'=>'id'], 
    'surname'        => ['rename'=>'achternaam'],
    'occupation'     => ['rename'=>'beroep'],
    'active'         => ['rename'=>'active', 'check'=>1]

];
printAsHtmlTable($member, $filter);


$members = getMembers(); //get member table from mysql and store as php array
//debugPrint($members);
$filter = 
[
    'contact_id'  => ['rename'=>'contact_id'], 
    'name'        => ['rename'=>'voornaam'],
    'surname'     => ['rename'=>'achternaam']
];
printAsHtmlTable($members, $filter);
