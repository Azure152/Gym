<?php 

/* <=== =====================================================
    Clase Controlador Entrenadores
===================================================== ===> */
class CoachController extends Controller {

    /* <== ========== Metodo - Inicio ========== ==> */
	public static function index() {
		self::model('Coach');
		$coachs = Coach::getAll();
		self::view('user/coachs', $coachs);
	}
    /* <== ========== Metodo - Aplicar a entrenador ========== ==> */
    public static function apply() {
    	self::onlyUserSession();
    	self::model('Coach');
    	$coach_apply = Coach::apply($_SESSION['user']['id']);

    	if ($coach_apply === true):
    		echo json_encode(['RESULT' => true, 'MSG' => 'La solicitud se ha enviado correctamente, el administrador se encargara de manejar la solicitud']);
    	else:
    		echo json_encode(['RESULT' => false, 'MSG' => 'Ha ocurrido un error al realizar la solicitud']);
    	endif;
    }
    /* <== ========== Metodo - Aplicar a entrenador ========== ==> */
    public static function show_applicants() {
    	self::view('admin/applicants');
    }

}