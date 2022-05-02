<?php 

/* <=== ======================================================================
    Clase Home, para el control del pagina de inicio
====================================================================== ===> */

class HomeController extends Controller {
    /* <== ========== Metodo - Pagina de inicio ========== ==> */
    public function index() {
        self::view('user/home');
    }
}