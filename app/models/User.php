<?php

/* <=== ======================================================================
    Clase User, Para el modelado de ususarios
====================================================================== ===> */

class User extends Model {

    /* <== ========== Metodo - Obtener usuario ========== ==> */
    public static function getOne($campo, $valor) {
        $conn = self::openConnection();
        $sql = $conn->prepare("SELECT * FROM users WHERE {$campo} = ?");
        $sql->bind_param('s', $valor);
        $sql->execute();
        $sql->bind_result($result[], $result[], $result[], $result[], $result[], $result[], $result[]);
        while ($sql->fetch()):
            $data = [
                'id' => $result[0],
                'name' => $result[1],
                'email' => $result[2],
                'phone_number' => $result[3],
                'password' => $result[4],
                'img' => $result[5],
                'role' => $result[6]
            ];
        endwhile;
        if (empty($data)):
            $data = [];
        endif;

        self::closeConnection($conn);

        return ['sql' => $sql, 'data' => $data];

    }
    /* <== ========== Metodo - Almacenar usuario ========== ==> */
    public static function store($data) {
        $data['img'] = 'IMG2.jpeg';
        $data['role'] = 2;
        $conn = self::openConnection();
        $sql = $conn->prepare("INSERT INTO users (name, email, phone_number, pass, img, role) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param('sssssi', $data['name'], $data['email'], $data['phone_number'], $data['password'], $data['img'], $data['role']);
        $sql->execute();
        if ($sql):
            // $sql->close();
            self::closeConnection($conn);
            // return $sql;
            return ['RESULT' => true, 'MSG' => 'El registro ha sido exitoso, ahora puede iniciar sesion.'];
        endif;

        self::closeConnection($conn);
    }
    /* <== ========== Metodo - Actualizar usuario ========== ==> */
    public static function update_info($id, $data) {
        $conn = self::openConnection();
        if (empty($_FILES['img_user']['tmp_name']) || empty($_FILES['img_user']['name'])):
            $data['email'] = strtolower($data['email']);
            $sql = $conn->prepare("UPDATE users SET name = ?, email = ?, phone_number = ? WHERE id = ?");
            $sql->bind_param('sssi', $data['name'], $data['email'], $data['phone_number'], $id);
            $sql->execute();
        else:
            date_default_timezone_set('America/Bogota');
            $date = date('Ymd_His');
            $img_name = $date . '_' . $_FILES['img_user']['name'];
            move_uploaded_file($_FILES['img_user']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/gym2/public/img/users/' . $img_name);
            $sql = $conn->prepare("UPDATE users SET name = ?, email = ?, phone_number = ?, img = ? WHERE id = ? LIMIT 1");
            $sql->bind_param('ssssi', $data['name'], $data['email'], $data['phone_number'], $img_name, $id);
            $sql->execute();
        endif;

        self::closeConnection($conn);
        if ($sql->affected_rows > 0):
            return true;
        elseif ($sql->affected_rows <= 0):
            return false;
        endif;
    }
    /* <== ========== Metodo - Actualizar contraseña ========== ==> */
    public static function update_password($id, $password) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $conn = self::openConnection();
        $sql = $conn->prepare('UPDATE users SET pass = ? WHERE id = ? LIMIT 1');
        $sql->bind_param('si', $password, $id);
        $sql->execute();
        self::closeConnection($conn);
        
        if ($sql->affected_rows > 0):
            return true;
        elseif ($sql->affected_rows <= 0):
            return false;
        endif;
    }
    /* <== ========== Metodo - Eliminar usuario ========== ==> */
    public static function destroy($id) {
        $conn = self::openConnection();
        $sql = $conn->prepare('DELETE FROM users WHERE id = ? LIMIT 1');
        $sql->bind_param('i', $id);
        $sql->execute();
        self::closeConnection($conn);

        if ($sql->affected_rows > 0):
            return true;
        else: 
            return false;    
        endif;
    }
}
