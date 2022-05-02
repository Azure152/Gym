<?php 

/* <=== ========================================================================
	Clase SellPoint, para el control de los puntos de venta
======================================================================== ==?> */

class SellPointController extends Controller {
    /* <== ========== Metodo - Obtener registro ========== ==> */
	public function getAll() {
		self::model('SellPoint');
		$sell_points = SellPoint::getALl();
		echo json_encode($sell_points);
	}
}