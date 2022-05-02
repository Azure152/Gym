<?php

/* <=== =====================================================
    Pidiendo los archivos
===================================================== ===> */

// require_once './app/libraries/functions.php';
require_once './app/controllers/Controller.php';

/* <=== =====================================================
    Clase Rutas
===================================================== ===> */

class Route extends Controller {
    private static $currentController = 'Welcome';
    private static $currentMethod = 'index';
    private static $params = [];
    private static $urlList = [];


    public static function start() {
        self::startFunction();
    }

    public static function get($url, $array, $data = []) {
        // print_r ($explode);
        self::$urlList[] = [
            'url' => $url,
            'controller' => $array[0],
            'method' => $array[1],
            'data' => $data,
            'request' => 'GET'
        ];
    }

    public static function post($url, $array, $data = []) {
        self::$urlList[] = [
            'url' => $url,
            'controller' => $array[0],
            'method' => $array[1],
            'data' => $data,
            'request' => 'POST'
        ];
    }




    /*
    * --------------------------------------------------------------------------
    *   Lo siguiente es un codigo espageti no apto para nadie, por favor
    *     retirese. ¡ESTA USTED ADVERTIDO!.
    * --------------------------------------------------------------------------
    *
    * Zona para agregar las funciones que hacen ilegible el codigo y lo hacen menos estetico.
    * Coloca un comentario para diferenciarlas.
    *
    */



    /* <=== ========= Metodo_Funcion - Funcion para iniciar la aplicacion =========  ===> */
    public static function startFunction(){
        if (!isset($_GET['url']) || empty($_GET['url']) ):
            $_GET['url'] = '/';
        endif;

        for ($i=0; $i < count(self::$urlList); $i++) {
            $getExplode = explode( '/', $_GET['url'] );
            $urlExplode = !( self::$urlList[$i]['url'] == '/' ) ? explode( '/', self::$urlList[$i]['url'] ) : ['/'] ;
            $get = implode('/', $getExplode);

            // print_r($getExplode);

            if (isset($getExplode[2])):
                $var = $getExplode;
                $var[2] = null;
                $get = implode('/', $var);
                unset($var);
            endif;

            if ( in_array( $get, self::$urlList[$i]) ):
                // $explode = explode( '/', $_GET['url']);
                $temp = isset($getExplode[2]) ? $getExplode[2] : [];
                $mvcData = [
                    'url' => self::$urlList[$i]['url'],
                    'controller' => self::$urlList[$i]['controller'],
                    'method' => self::$urlList[$i]['method'],
                    'data' => $temp,
                    'request' => self::$urlList[$i]['request']
                ];

                unset($temp);

                if ($_SERVER['REQUEST_METHOD'] == $mvcData['request']):
                    require_once "./app/controllers/{$mvcData['controller']}Controller.php";
                    self::$currentController = $mvcData['controller'] . 'Controller';
                    self::$currentController = new self::$currentController;
                    self::$currentMethod = $mvcData['method'];
                    self::$params = !empty($params) ? $mvcData['data'] : $mvcData['data'];
                    $method = self::$currentMethod;
                    self::$currentController->$method(self::$params);
                    exit();
                endif;

            endif;

            if ( end(self::$urlList)['url'] == self::$urlList[$i]['url'] ):
                if ($get != 'app/libraries/'):
                    self::view('others/404');
                endif;
            endif;

        }


    }

    /* <=== ========= Metodo_Funcion - Funcion para ??? =========  ===> */

}
