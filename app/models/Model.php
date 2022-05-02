<?php

/* <=== =====================================================
    Clase Modelo
===================================================== ===> */

class Model {
    protected static $dbHost = 'localhost';
    protected static $dbUser = 'root';
    protected static $dbPass = '';
    protected static $dbName = 'myb2';

    /* <=== ========= Metodo - Abrir Conexion =========  ===> */
    protected static function openConnection() {
        $conn = new mysqli(self::$dbHost, self::$dbUser, self::$dbPass, self::$dbName);
        $conn->set_charset('utf-8');
        return $conn;
    }

    /* <=== ========= Metodo - Cerrar Conexion =========  ===> */
    protected static function closeConnection($conn) {
        $conn->close();
    }
    /* <=== ========= Metodo - Encriptar  =========  ===> */
    public static function encryption($string){
        $output=FALSE;
        $key=hash('sha256', ENCRYPT_KEY);
        $iv=substr(hash('sha256', ENCRYPT_IV), 0, 16);
        $output=openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
    /* <=== ========= Metodo - Desencriptar  =========  ===> */
    public static function decryption($string){
        $key=hash('sha256', ENCRYPT_KEY);
        $iv=substr(hash('sha256', ENCRYPT_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), ENCRYPT_METHOD, $key, 0, $iv);
        return $output;
    }
}
