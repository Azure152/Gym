<?php

/* <=== ======================================================================
    Clase Product, para el control de los productos
====================================================================== ===> */

class ProductController extends Controller {

	/* ------------------------------------------------------------------------ 
 		Seccion de Usuario Comun
	------------------------------------------------------------------------ */

    /* <== ========== Metodo - Todos los productos ========== ==> */
	public function index() {
		self::userSession();
		self::model('Product');
		$products = Product::getProducts();
		self::view('user/products', $products);
	}

	/* ------------------------------------------------------------------------ 
 		Seccion de administrador
	------------------------------------------------------------------------ */

	/* <== ========== Metodo - Productos para el administrador ========== ==> */
	public function admin_index() {
		self::adminSession();
		self::model('Product');
		if (isset($_GET['search']) && isset($_GET['filter'])):
			$products = Product::search('name', $_GET['search'], $_GET['filter']);
		else:
			$products = Product::getProducts();
		endif;
		self::view('admin/products', $products);
	}
	/* <== ========== Metodo - Crear producto ========== ==> */
	public function store($data_ajax) {
		self::adminSession();
		if( empty($_FILES['input_file_img']['name']) || empty($data_ajax['name']) || empty($data_ajax['price']) || empty($data_ajax['amount']) || empty($data_ajax['price']) || empty($data_ajax['sell_point']) ):
			echo json_encode(['RESULT' => false, 'MSG' => 'Ninguno de los campos puede estar vacio']);
		elseif( !is_numeric($data_ajax['amount']) || !is_numeric($data_ajax['price']) ) :
			echo json_encode(['RESULT' => false, 'MSG' => 'El precio y la cantidad solo pueden ser numeros enteros']);
		else:
			self::model('Product');
			$store_result = Product::store($data_ajax);
			if ($store_result === true):
				echo json_encode(['RESULT' => true, 'MSG' => 'producto creado correctamente, por favor reinicie']);
			endif;
		endif;
	}
	/* <== ========== Metodo - Editar producto ========== ==> */
	public function edit($id) {
		$id = self::decryption($id);
		if (!isset($id) || empty($id) || $id == false):
			self::view('others/404');
			exit();
		endif;
		self::adminSession();
		self::model('Product');
		$product = Product::getProduct($id);
		self::model('SellPoint');
		$sell_points = SellPoint::getAll();
		$data = [ 'product' => $product[0], 'sell_points' => $sell_points ];
		self::view( 'admin/product_edit', $data );
	}
	/* <== ========== Metodo - Actualizar producto ========== ==> */
	public function update($data_ajax) {
		self::adminSession();
		$data_ajax['id'] = self::decryption($data_ajax['id']);
		$data_ajax['sell_point'] = self::decryption($data_ajax['sell_point']);

		if ( $data_ajax['id'] == false || !isset($data_ajax['id']) || empty($data_ajax['id']) ):
			echo json_encode(['RESULT' => false, 'MSG' => 'TENGO TU  IP QUE LO SEPAS!']);
		elseif ( $data_ajax['sell_point'] == false || !isset($data_ajax['sell_point']) || empty($data_ajax['sell_point']) ):
			echo json_encode(['RESULT' => false, 'MSG' => 'Seleccione un punto de venta valido']);
		elseif ( empty($data_ajax['name']) || empty($data_ajax['price']) || empty($data_ajax['amount']) || empty($data_ajax['sell_point']) || empty($data_ajax['description']) ):
			echo json_encode(['RESULT' => false, 'MSG' => 'Ninguno de los campos puede estar vacio']);
		elseif ( !is_numeric($data_ajax['price']) || !is_numeric($data_ajax['amount']) ):
			echo json_encode(['RESULT' => false, 'MSG' => 'El precio y la cantidad de unidades deben ser numeros']);
		elseif ( !is_numeric($data_ajax['sell_point']) ):
			echo json_encode(['RESULT' => false, 'MSG' => 'Seleccione un punto de venta valido']);
		else:
			self::model('Product');
			$update_product = Product::update($data_ajax);
			if ($update_product == false):
				echo json_encode(['RESULT' => false, 'MSG' => 'Imagen no seleccionada', 'ESO' => $_FILES]);
			else:
				echo json_encode(['RESULT' => true, 'MSG' => 'Producto creado exitosamente']);
			endif;
		endif;
	}

	/* ------------------------------------------------------------------------ 
 		Seccion de Metodos mixtos
	------------------------------------------------------------------------ */

	/* <== ========== Metodo - Obtener productos para presentacion sencilla ========== ==> */
	public function getProduct($data_ajax) {
		$id = Controller::decryption($data_ajax['id']);
		self::model('Product');
		$product = Product::getProduct($id);
		self::model('SellPoint');
		$product[0]['sell_point'] = SellPoint::getOne($product[0]['sell_point']);
		$product[0]['sell_point'] = $product[0]['sell_point']['name'];

		echo json_encode($product);
	}

}
