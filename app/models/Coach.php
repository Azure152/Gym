<?php 

/* <=== =====================================================
    Clase Controlador Entrenadores
===================================================== ===> */
class Coach extends Model {

    /* <== ========== Metodo - Obtener todos los registros ========== ==> */
	public static function getAll() {
		$conn = self::openConnection();

		$sql = $conn->prepare('SELECT id, name, email, phone_number, img FROM users WHERE role = 3');
		$sql->execute();
		$sql->bind_result($result[], $result[], $result[], $result[], $result[]);

		while ($sql->fetch()):
			$data[] = [
				'id' => $result[0],
				'name' => $result[1],
				'email' => $result[2],
				'phone_number' => $result[3],
				'img' => $result[4]
			];
		endwhile;

		if (!isset($data)):
			$data = [];
		endif;

		self::closeConnection($conn);
		return $data;
	}
    /* <== ========== Metodo - Obtener todos los registros ========== ==> */
    public static function apply($id) {
		$conn = self::openConnection();
		date_default_timezone_set('America/Bogota');
        $timestamp = date('Y-m-d H:i:s');

		$sql = $conn->prepare('INSERT INTO applicants(send, id_applicant) VALUES (?, ?)');
		$sql->bind_param('si', $timestamp, $id);
		$sql->execute();

		self::closeConnection($conn);

		if ($sql):
			return true;
		else:
			return false;
		endif;
    }

}