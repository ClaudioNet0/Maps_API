<?php
namespace DAL;

use PDO;
use PDOStatement;

class Cnn{
    public static function getCnn(){
        $dns = "mysql:host=localhost;dbname=YOUR_db";
        $dbuser = "YOUR_USER";
        $dbpass = "YOUR_PASSWORD";

        $pdo = new PDO($dns,$dbuser, $dbpass);

        return $pdo;
    }

    /**
     * @param PDOStatement $db
     * @param string $className
     * @return null|mixed
     */
    public static function getValue($db, $className) {
        $retorno = array();
        $db->execute();
        while ($row = $db->fetchObject($className)) {
            $retorno[] = $row;
        }
        $db->closeCursor();
        return $retorno;
    }
}
