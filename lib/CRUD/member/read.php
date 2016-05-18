<?php

// ==================
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





function getMembersKeysAsTableCols($records) {
    //var_dump($records);
    $keys = array_keys($records[0]);    
    
    $table_str = "\n<tr>";    
    for($i=0; $i<count($keys); $i++)
    {
        $table_str .= '<td>' . $keys[$i] . '</td>';
    }    
    $table_str .= "</tr>\n";
    return $table_str;
}

function getMembersValsAsTableRows($records) {
    var_dump($records);
    $table_str = "";
    foreach ($records as $record_key => $record) {
            $id = $record['contact_id'];
            $table_str .= "<tr onclick=\"window.document.location='http://127.0.0.1/Manday1/member.php?id=$id'\" id=\"{$record['id']}\">";
            foreach ($record as $field_key => $field_value) {
                    $table_str .= sprintf("<td>%s</td>", $field_value);
            }
            $table_str .= "</tr>\n";
    }
    return $table_str;
}

function printAsMembersHtmlTable($table, $filter){

    $members_filtered = getFilteredArray($table, $filter);

    $table_str = "<table table border='1' cellspacing='1'>"; 
    $table_str .= getMembersKeysAsTableCols($members_filtered);
    $table_str .= getMembersValsAsTableRows($members_filtered);
    $table_str .= "</table>";

    echo $table_str;    
}

