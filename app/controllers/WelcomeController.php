<?php 

class WelcomeController extends Controller {

    public function index() {
        self::view('welcome/index');
    }
    
    public function show() {
        self::view('welcome/show');
    }
}