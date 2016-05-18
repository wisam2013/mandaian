<?php 
    /*
     * http://php.net/manual/en/class.pdo.php
     */
    class DB 
    {
        private static $link = null ;

        private static function getLink ( ) 
        {
            if ( self :: $link ) {
                return self :: $link ;
            }

            $ini = dirname(__FILE__) . "/../config.ini" ;
            $parse = parse_ini_file ( $ini , true ) ;

            $driver = $parse [ "db_driver" ] ;
            $dsn = "${driver}:" ;
            $user = $parse [ "db_user" ] ;
            $password = $parse [ "db_password" ] ;
            $options = $parse [ "db_options" ] ;
            $attributes = $parse [ "db_attributes" ] ;

            foreach ( $parse [ "dsn" ] as $k => $v ) {
                $dsn .= "${k}=${v};" ;
            }
                    
            self :: $link = new PDO ( $dsn, $user, $password, $options ) ;

            foreach ( $attributes as $k => $v ) {
                self :: $link -> setAttribute ( constant ( "PDO::{$k}" )
                    , constant ( "PDO::{$v}" ) ) ;
            }

            return self :: $link ;
        }

        public static function __callStatic ( $name, $args ) 
        {
            $callback = array ( self :: getLink ( ), $name ) ;
            return call_user_func_array ( $callback , $args ) ;
        }
    } 

/*  Usage Example:
    <?php
        $stmt = Database :: prepare ( "SELECT 'something' ;" ) ;
        $stmt -> execute ( ) ;
        var_dump ( $stmt -> fetchAll ( ) ) ;
        $stmt -> closeCursor ( ) ;
    ?>
*/
?>


