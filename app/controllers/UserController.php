<?php

/* <=== ======================================================================
    Clase User, para el control de los usuario
====================================================================== ===> */

class UserController extends Controller {

    /* <== ========== Metodo - Ingresar ========== ==> */
    public function login() {
        self::view('session/login');
    }
    /* <== ========== Metodo - Registro ========== ==> */
    public function register() {
        session_start();
        session_unset();
        session_destroy();
        self::view('session/register');
    }
    /* <== ========== Metodo - Cerrar session ========== ==> */
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        self::redirect('/login');
    }
    /* <== ========== Metodo - perfil ========== ==> */
    public function profile() {
        self::userSession();
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])):
            self::redirect('/login');
        else:
            self::view('user/profile', $_SESSION['user']);
        endif;
    }
    /* <== ========== Metodo - eliminar ========== ==> */
    public function delete($id) {
        $id = decryption($id);
        if ($id === false || !is_numeric($id) ):
            self::view('others/404');
            return false;
        else: 
            self::model('User');
            $user_delete = User::destroy($id);
            if ($user_delete === true):
                session_start();
                session_unset();
                session_destroy();
                self::redirect('/login');
                return true;
            else: 
                self::view('others/404');
                return false;
            endif;
        endif;
    }
    /* <== ========== Metodo - Actulizar informacion del perfil ========== ==> */
    public function update_info($data_ajax) {
        if (empty($data_ajax['name']) ||
            empty($data_ajax['email']) ||
            empty($data_ajax['phone_number']) ||
            empty($_FILES['img_user'])):

            echo json_encode(['RESULT' => false, 'MSG' => 'Ninguno de los campos puede estar vacio.']);
        elseif (!str_contains($data_ajax['email'], '@') || !str_contains($data_ajax['email'], '.')):
            echo json_encode(['RESULT' => false, 'MSG' => 'Utilice un formato de correo electronico valido']);
        elseif (!is_numeric($data_ajax['phone_number']) || strlen($data_ajax['phone_number']) < 7 || strlen($data_ajax['phone_number']) > 10 ):
            echo json_encode(['RESULT' => false, 'MSG' => 'Utilice un numero de telefono o celular valido']);
        else:
            session_start();
            self::model('User');
            $update = User::update_info($_SESSION['user']['id'], $data_ajax);
            if ($update):
                session_unset();
                $get_user = User::getOne('email', $data_ajax['email']);
                $_SESSION['user']  = $get_user['data'];
                echo json_encode(['RESULT' => true, 'MSG' => 'Datos actualizados correctamente, por favor recargue la pagina']);
            else:
                echo json_encode(['RESULT' => false, 'MSG' => 'No se pudieron actualizar los datos']);
            endif;
        endif;
    }
    /* <== ========== Metodo - Actulizar contraseña ========== ==> */
    public function update_password($data_ajax) {
        // echo json_encode($data_ajax);
        if ( empty($data_ajax['old_password']) || empty($data_ajax['new_password']) ):
            echo json_encode(['RESULT' => false, 'MSG' => 'Ninguno de los campos puede estar vacio.']);
        else:
            session_start();
            if (!password_verify($data_ajax['old_password'], $_SESSION['user']['password'])):
                echo json_encode(['RESULT' => false, 'MSG' => 'La contraseña antigua no coincide con la contraseña actual de la cuenta.']);
            else:
                if ($data_ajax['old_password'] === $data_ajax['new_password']):
                    echo json_encode(['RESULT' => false, 'MSG' => 'La nueva contraseña no puede ser igual a la antigua.']);
                else:
                    self::model('User');
                    $id = $_SESSION['user']['id'];
                    $update = User::update_password($id, $data_ajax['new_password']);

                    if ($update):
                        session_unset();
                        $get_user = User::getOne('id', $id);
                        $_SESSION['user']  = $get_user['data'];
                        echo json_encode(['RESULT' => true, 'MSG' => 'La contraseña se cambio correctamente, por favor recargue la pagina']);
                    else:
                        echo json_encode(['RESULT' => false, 'MSG' => 'No se pudo cambiar la contraseña']);
                    endif;
                endif;
            endif;
        endif;

    }
    /* <== ========== Metodo - Ingresar ========== ==> */
    public function ingres($data_ajax) {
        if (empty($data_ajax['email']) || empty($data_ajax['password']) ):
            echo json_encode(['RESULT' => false, 'MSG' => 'Ninguno de los campos puede estar vacio.']);
        elseif (!str_contains($data_ajax['email'], '@') || !str_contains($data_ajax['email'], '.')):
            echo json_encode(['RESULT' => false, 'MSG' => 'Utilice un formato de correo electronico valido']);
        else:
            self::model('User');
            $get_user = User::getOne('email', $data_ajax['email']);
            if (empty($get_user['data'])):
                echo json_encode(['RESULT' => false, 'MSG' => 'No se encontro al usuario en la base de datos, revise que la direccion de correo electronico sea correcta']);
            else:
                if (!password_verify($data_ajax['password'], $get_user['data']['password'])):
                    echo json_encode(['RESULT' => false, 'MSG' => 'Contraseña incorrecta']);
                else:
                    session_start();
                    $_SESSION['user'] = $get_user['data'];
                    if ($_SESSION['user']['role'] == 2):
                        echo json_encode(['RESULT' => true, 'MSG' => 'El correo y la contraseña son correctos, se ha creado la session, esta se matendra hasta que se cierre o hasta el cierre del navegador', 'ROLE' => 2]);
                    elseif ($_SESSION['user']['role'] == 1):
                        echo json_encode(['RESULT' => true, 'MSG' => 'El correo y la contraseña son correctos, se ha creado la session, esta se matendra hasta que se cierre o hasta el cierre del navegador', 'ROLE' => 1]);
                    endif;
                endif;
            endif;
        endif;
    }
    /* <== ========== Metodo - Almacenar nuevo registro de usuario ========== ==> */
    public function store($data_ajax) {
        if (empty($data_ajax['name']) ||
            empty($data_ajax['email']) ||
            empty($data_ajax['phone_number']) ||
            empty($data_ajax['password'])):

            echo json_encode(['RESULT' => false, 'MSG' => 'Ninguno de los campos puede estar vacio.']);
        elseif (!str_contains($data_ajax['email'], '@') || !str_contains($data_ajax['email'], '.')):
            echo json_encode(['RESULT' => false, 'MSG' => 'Utilice un formato de correo electronico valido']);
        elseif (!is_numeric($data_ajax['phone_number']) || strlen($data_ajax['phone_number']) < 7 || strlen($data_ajax['phone_number']) > 10 ):
            echo json_encode(['RESULT' => false, 'MSG' => 'Utilice un numero de celular valido']);
        else:
            $data_ajax['email'] = strtolower($data_ajax['email']);
            $data_ajax['password'] = password_hash($data_ajax['password'], PASSWORD_BCRYPT);
            self::model('User');
            $Result2 = User::getOne('email', $data_ajax['email']);
            if (!empty($Result2['data'])):
                echo json_encode([ 'RESULT' => false, 'MSG' => 'El correo que ha digitado ya esta siendo usado']);
            else:
                $Result = User::store($data_ajax);
                echo json_encode($Result);
            endif;
        endif;
    }
}
