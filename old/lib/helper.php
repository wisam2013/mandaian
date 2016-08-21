<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getFilteredArray($arr, $filter) 
{
    $counter = 0;
    $members_filtered = [];
    foreach ($arr as $record) {

        $valid = true;
        foreach ($record as $key => $val)
        {

            if (array_key_exists($key, $filter))
            {
                if(isset($filter[$key]['rename'])) 
                { 
                    $filter_keyname = $filter[$key]['rename'];

                } else
                {
                    $filter_keyname = $key;
                }

                if (isset($filter[$key]['check']))
                {   
                    if ($filter[$key]['check'] == $val)
                    {
                        //$members_filtered[$counter][$filter_keyname] = $filter[$key]['check'];
                        $data[$filter_keyname] = $filter[$key]['check']; 
                    }
                    else
                    {
                        $valid = false;
                    }
                    //$members_filtered[$counter][$filter_keyname] = 'egwaar';
                    } else
                    {
                        $data[$filter_keyname] = $val;
                        //$members_filtered[$counter][$filter_keyname] = $val;
                    }
                 }
            }

            if ($valid == true) 
            {
                //echo "dump data = ";                    
                //var_dump($data);                                    
                $members_filtered[$counter] = $data;
                $counter++;
            }
        }
    return $members_filtered;        
}        


function printRecordset1($records) {
    $keys = array_keys($records[0]);    
    var_dump($keys);
    $table_str = "<br> <table border='1' cellspacing='1'>";		
    $table_str .= "<tr>";    
    for($i=0; $i<count($keys); $i++)
    {
        $table_str .= '<td>' . $keys[$i] . '</td>';
    }    
    $table_str .= "</tr>";
    
    foreach ($records as $record_key => $record) {
            $table_str .= "<tr>";
            foreach ($record as $field_key => $field_value) {
                    $table_str .= sprintf("<td>%s</td>", $field_value);
            }
            $table_str .= "</tr>";
    }
    $table_str .= "</table>";		    
    echo $table_str;
}


function getKeysAsTableCols($records) {
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

function getValsAsTableRows($records) {
    //var_dump($records);
    $table_str = "";
    foreach ($records as $record_key => $record) {
            $table_str .= "<tr id=\"{$record['id']}\">";
            foreach ($record as $field_key => $field_value) {
                    $table_str .= sprintf("<td>%s</td>", $field_value);
            }
            $table_str .= "</tr>\n";
    }
    return $table_str;
}

function debugPrint($arr) {
        echo "<pre>"; var_dump($arr); echo "</pre>";
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




