<?php

/* <=== ======================================================================
    Clase Product, para el control de los productos
====================================================================== ===> */

class Product extends Model {
    /* <== ========== Metodo - Obtener productos para presentacion sencilla ========== ==> */
    public static function getProducts() {
        $conn = self::openConnection();
        $sql =  $conn->prepare("SELECT id, name, img FROM products");
        $sql->execute();
        $sql->bind_result($result[], $result[], $result[]);
        while ($sql->fetch()):
            $data[] = [
                'id' => $result[0],
                'name' => $result[1],
                'img' => $result[2]
            ];
        endwhile;
        if(!isset($data)):
            $data = [];
        endif;
        self::closeConnection($conn);
        return $data;
    }
    /* <== ========== Metodo - Obtener datos de un producto ========== ==> */
    public static function getProduct($id) {
        $conn = self::openConnection();
        $sql =  $conn->prepare("SELECT id, name, price, amount, description, img, sell_point_id FROM products WHERE id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $sql->bind_result($result[], $result[], $result[], $result[], $result[], $result[], $result[]);
        while ($sql->fetch()):
            $data[] = [
                'id' => $result[0],
                'name' => $result[1],
                'price' => $result[2],
                'amount' => $result[3],
                'description' => $result[4],
                'img' => $result[5],
                'sell_point' => $result[6]

            ];
        endwhile;
        if(!isset($data)):
            $data = [];
        endif;
        self::closeConnection($conn);
        return $data;
    }
    /* <== ========== Metodo - Obtener productos para presentacion sencilla ========== ==> */
    public static function search($campo, $valor, $order) {
        $conn = self::openConnection();
        $sql = $conn->prepare("SELECT id, name, img FROM products WHERE {$campo} LIKE CONCAT('%',?,'%') ORDER BY {$campo} {$order} ");
        $sql->bind_param('s', $valor);
        $sql->execute();
        $sql->bind_result($result[], $result[], $result[]);

        while ($sql->fetch()):
            $data[] = [
                'id' => $result[0],
                'name' => $result[1],
                'img' => $result[2]
            ];
        endwhile;

        if(!isset($data)):
            $data = [];
        endif;

        self::closeConnection($conn);
        return $data;
    }
    /* <== ========== Metodo - Almacenar datos de un producto ========== ==> */
    public static function store($data_ajax) {
        $conn = self::openConnection();

        date_default_timezone_set('America/Bogota');
        $date = date('Ymd_His');
        $img_name = $date . '_' . $_FILES['input_file_img']['name'];
        move_uploaded_file($_FILES['input_file_img']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/gym2/public/img/products/' . $img_name);

        $sql = $conn->prepare("INSERT INTO products (name, price, amount, img, sell_point_id) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param('siisi', $data_ajax['name'], $data_ajax['price'], $data_ajax['amount'], $img_name, $data_ajax['sell_point']);
        $sql->execute();
        self::closeConnection($conn);

        if ($sql):
            return true;
        else:
            return false;
        endif;
    }
    /* <== ========== Metodo - Actualizar un producto ========== ==> */
    public static function update($data_ajax) {
        $conn = self::openConnection();

        if (empty($_FILES['img_product']['tmp_name'])):
            $sql = $conn->prepare('UPDATE products SET name = ?, price = ?, amount = ?, description = ?, sell_point_id = ? WHERE id = ?');
            $sql->bind_param('siisii', $data_ajax['name'], $data_ajax['price'], $data_ajax['amount'], $data_ajax['description'], $data_ajax['sell_point'], $data_ajax['id']);
            $sql->execute();
        else:
            // Guardar imagen
            date_default_timezone_set('America/Bogota');
            $date = date('Ymd_His');
            $img_name = $date . '_' . $_FILES['img_product']['name'];
            move_uploaded_file($_FILES['img_product']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/gym2/public/img/products/' . $img_name);
            // Actualizar informacion de la tabla
            $sql = $conn->prepare('UPDATE products SET name = ?, price = ?, amount = ?, description = ?, img = ?, sell_point_id = ? WHERE id = ?');
            $sql->bind_param('siissii', $data_ajax['name'], $data_ajax['price'], $data_ajax['amount'], $data_ajax['description'], $img_name, $data_ajax['sell_point'], $data_ajax['id']);
            $sql->execute();
        endif;

        self::closeConnection($conn);

        if ($sql->affected_rows > 0):
            return true;
        else:
            return false;
        endif;
    }
}
