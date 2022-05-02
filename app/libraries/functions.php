<?php

/* <=== ========================================================================
	Seccion de funciones
======================================================================== ==?> */
define('APP_ROOT', dirname(dirname(__FILE__)));

require_once APP_ROOT.'/controllers/Controller.php';
require_once APP_ROOT.'/Models/Model.php';

/* <=== ========================================================================
	Seccion de la declaracion para el ajax
======================================================================== ==?> */

$data_ajax = $_POST;

if (isset($data_ajax) && !empty($data_ajax)):
	if ($data_ajax['type'] === 'register_user'):
		$currentController = 'User';
		$currentMethod = 'store';
	elseif ($data_ajax['type'] === 'login_user' ):
		$currentController = 'User';
		$currentMethod = 'ingres';
	elseif ($data_ajax['type'] === 'change_password_user'):
		$currentController = 'User';
		$currentMethod = 'update_password';
	elseif ($data_ajax['type'] === 'update_user'):
		$currentController = 'User';
		$currentMethod = 'update_info';
	elseif ($data_ajax['type'] === 'create_product'):
		// echo json_encode(['RESULT' => false, 'MSG' => 'HOLA']);
		$currentController = 'Product';
		$currentMethod = 'store';
	elseif ($data_ajax['type'] === 'update_product'):
		$currentController = 'Product';
		$currentMethod = 'update';
	endif;

	if (isset($currentController) && !empty($currentController)):
		require_once APP_ROOT."/controllers/{$currentController}Controller.php";
		$currentController = $currentController . 'Controller';
		$currentController = new $currentController;
		$currentController->$currentMethod($data_ajax);
	else:
		echo json_encode( ['RESULT' => false, 'MSG' => 'Ha ocurrido un error!'] );
	endif;
elseif( !empty(json_decode(file_get_contents('php://input'), true)) ):
	$data_ajax = json_decode(file_get_contents('php://input'), true);
	// echo json_encode( $data_ajax );
	if ($data_ajax['type'] === 'get_product_user'):
		$currentController = 'Product';
		$currentMethod = 'getProduct';
	elseif ($data_ajax['type'] === 'get_sell_point'):
		$currentController = 'SellPoint';
		$currentMethod = 'getAll';
	elseif ($data_ajax['type'] === 'apply_coachs'):
		$currentController = 'Coach';
		$currentMethod = 'apply';
	endif;

	if (isset($currentController) && !empty($currentController)) {
		require_once APP_ROOT."/controllers/{$currentController}Controller.php";
		$currentController = $currentController . 'Controller';
		$currentController = new $currentController;
		$currentController->$currentMethod($data_ajax);
	} else {
		echo json_encode( ['RESULT' => false, 'MSG' => 'Ha ocurrido un error!'] );
	}
endif;
