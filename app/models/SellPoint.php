<?php 

/* <=== ========================================================================
	Clase SellPoint, para el control de la tabla sell_point
======================================================================== ==?> */

class SellPoint extends Model {
    /* <== ========== Metodo - Obtener todos los registros ========== ==> */
	public static function getAll() {
		$conn = self::openConnection();
		$sql = $conn->prepare("SELECT id, name FROM sell_point");
		$sql->execute();
		$sql->bind_result($result[], $result[]);

		while ($sql->fetch()):
			$data[] = [
				'id' => $result[0],
				'name' => $result[1]
			];
		endwhile;

		self::closeConnection($conn);
		if (!isset($data)):
			$data = [];
		endif;
		return $data; 
	}
    /* <== ========== Metodo - Obtener un registro ========== ==> */
	public static function getOne($id) {
		$conn = self::openConnection();
		$sql = $conn->prepare("SELECT id, name FROM sell_point WHERE id = ? LIMIT 1");
		$sql->bind_param('i', $id);
		$sql->execute();
		$sql->bind_result($result[], $result[]);

		while ($sql->fetch()):
			$data = [
				'id' => $result[0],
				'name' => $result[1]
			];
		endwhile;

		self::closeConnection($conn);
		if (!isset($data)):
			$data = [];
		endif;
		return $data; 
	}
}