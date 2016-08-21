<?php

    require(dirname(__FILE__)."/lib/autoloader.php");    
    require(dirname(__FILE__)."/lib/database.php");
    require(dirname(__FILE__)."/lib/helper.php");
    
    // autoloader checks if Class files exists
    // during via object instantiation or static usage.
    $autoloader = new ClassAutoloader();

    
$sql_insert_member_status =  <<< SQL
INSERT INTO `member_status`
(
    `id`,
    `deceased`,
    `date`,
    `color_alive_deceased`
) VALUES
(
    :id,
    :deceased,
    :date,
    :color_alive_deceased
);
SQL;

    
$sql_member_update = <<< SQL
UPDATE `MendayInHolland`.`members` 
    SET 
        `member_status_id` = :member_status_id
    WHERE 
        `members`.`id` = :id;
SQL;

$sql_member_status_auto_increment = <<< SQL
SELECT `auto_increment` AS id
FROM INFORMATION_SCHEMA.TABLES
WHERE table_name = 'member_status'
LIMIT 0 , 30
SQL;

$sql_insert_member = <<< SQL
INSERT INTO `members` 
(
    `member_status_id`,
    `name`, 
    `surname`, 
    `date_of_birth`, 
    `marital_status`, 
    `postcode`, 
    `place_of_birth`,
    `active`
) VALUES 
(
    :member_status_id,
    :name,
    :surname,
    :date_of_birth,
    :marital_status,
    :postcode,
    :place_of_birth,
    :active
)
SQL;

    $member_data_1 = 
    [
        ':member_status_id' => '',
        ':name' => 'A',
        ':surname' => 'nonymous',
        ':date_of_birth' => '1900-01-01',
        ':marital_status' => 'divorced',
        ':postcode' => 'Schaakweg 11',
        ':place_of_birth' => 'Nowhere',        
        ':active' => '0',
    ];

    $member_data_2 = 
    [
        ':name' => 'John',
        ':surname' => 'Doe',
        ':date_of_birth' => '1970-01-01',
        ':marital_status' => 'widow',
        ':postcode' => 'Eindeweg 10',
        ':place_of_birth' => 'Eendjesdorp',        
        ':active' => '0',
    ];  


    $member_status_data = 
    [
        ':id' => 0,
        ':deceased' => 0,
        ':date' => '',
        ':color_alive_deceased' => '#00ff00;#909090',
    ];

    
    DB :: beginTransaction();
    try {
            
            echo "\n SP0 \n";                    
            $stmt = DB :: prepare($sql_member_status_auto_increment);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);    
            $member_status_id = $result['id'];
            
            $member_data_1[':member_status_id'] = $member_status_id; 
            $stmt = DB :: prepare($sql_insert_member);
            $stmt->execute($member_data_1);
            echo $stmt->debugDumpParams() . "\n";
            
            //$member_status_data[':id'] = DB :: lastInsertId('member_status_id');
            //echo "Inserted member_status_id = " . $member_status_id;

            echo "\n SP1 \n";            

            //echo "member_status[':id'] = " . $member_status_data[':id'] . "\n" ;         
            $stmt = DB :: prepare($sql_insert_member_status);
            $stmt->execute($member_status_data);

            echo "\n SP2 \n";            
  
            DB :: commit();  
          
    } catch (Exception $e) 
    {
        // any errors from the above database queries will be catched
        // roll back transaction
        echo "\n SP-1 \n";            
        echo "stmt->debugDumpParams() = " . $stmt->debugDumpParams();
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'Performing rollback';
        DB :: rollback();
        $stmt -> closeCursor ( ) ;            
        exit;
    } finally 
    {
        $stmt -> closeCursor ( ) ;
    }

    $stmt -> closeCursor ( ) ;    
    
    DB :: beginTransaction();
    try
    {
        $query = "select * from members;";
        $stmt = DB :: prepare ( $query ) ;
        $stmt -> execute ( ) ;
        $getrows = $stmt -> fetchAll();

        echo "<pre>";
           print_r($getrows);
        echo "</pre>";
        printRecordsetTable($getrows);    
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'Performing rollback';
        DB :: rollback();
        exit;
    } finally 
    {
        $stmt -> closeCursor ( ) ;                    
    }

?>


    