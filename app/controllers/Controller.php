<?php

/* <=== =====================================================
    Clase Controlador
===================================================== ===> */
require_once $_SERVER['DOCUMENT_ROOT']. '/gym2/app/libraries/config.php';

class Controller {

    /* <=== ========= Metodo - Llamar Modelo =========  ===> */
    protected static function model($model) {
        if (file_exists("./app/models/{$model}.php")):
            return require_once "./app/models/{$model}.php";
        elseif(file_exists(APP_ROOT."/models/{$model}.php")):
            return require_once APP_ROOT."/models/{$model}.php";
        endif;
    }
    /* <=== ========= Metodo - Llamar Vista =========  ===> */
    protected static function view($view, $data = []) {
        if (file_exists("./app/views/{$view}-view.php")):
            return require_once "./app/views/{$view}-view.php";
        else:
            return require_once "./app/views/others/404-view.php";
        endif;
    }
    /* <=== ========= Metodo - Redireccionar  =========  ===> */
    protected static function redirect($url) {
        header('location: '. SERVER_URL . $url);
    }
    /* <=== ========= Metodo - Session de admin  =========  ===> */
    protected static function adminSession() {
        session_start();
        if ( $_SESSION['user']['role'] != 1):
            if ($_SESSION['user']['role'] == 2):
                return self::redirect('/products');
            else:
                self::view('others/404');
                exit();
            endif;
        endif;
    }
    /* <=== ========= Metodo - Session de usuario  =========  ===> */
    protected static function userSession() {
        session_start();
        if ( $_SESSION['user']['role'] != 2 or $_SESSION['user']['role'] != 3):
            if ($_SESSION['user']['role'] == 1):
                return self::redirect('/admin/products');
            else:
                self::view('others/404');
                exit();
            endif;
        endif;
    }
    /* <=== ========= Metodo - Session solo de "usuarios"  =========  ===> */
    protected static function onlyUserSession() {
        session_start();
        if ( $_SESSION['user']['role'] != 2):
            if ($_SESSION['user']['role'] == 1):
                return self::redirect('/admin/products');
            else:
                self::view('others/404');
                exit();
            endif;
        endif;
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
