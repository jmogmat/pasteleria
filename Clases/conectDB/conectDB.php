<?php

namespace conectDB;

require_once __DIR__ . '/../../autoload.php';

use \email\email as email;

class conectDB {

    private $ip;
    private $nameBD;
    private $user;
    private $password;
    private $pdo;
    private $fileXML = __DIR__ . '/../../config/configurationdb.xml';
    private $fileXSD = __DIR__ . '/../../config/configurationdb.xsd';

    function __construct($rol) {

        $data = $this->readConfiguration($this->fileXML, $this->fileXSD, $rol);

        $this->nameBD = $data[0];
        $this->ip = $data[1];
        $this->user = $data[2];
        $this->password = $data[3];

        $this->pdo = $this->conect();
    }

    public function readConfiguration($fileXML, $fileXSD, $rol) {

        $conf = new \DOMDocument();

        $conf->load($fileXML);

        if (!$conf->schemaValidate($fileXSD)) {
            throw new \PDOException('Fichero de usuarios no valido.');
        }

        $xml = simplexml_load_file($fileXML);

        $array = [
            "" . $xml->xpath('//dbname')[0],
            "" . $xml->xpath('//ip')[0],
            "" . $xml->xpath('//nombre[../rol="' . $rol . '"]')[0],
            "" . $xml->xpath('//password[../rol="' . $rol . '"]')[0]
        ];
        return $array;
    }

    protected function conect() {
        try {
            $pdo = new \PDO("mysql:host=" . $this->ip . ";dbname=" . $this->nameBD . ";charset=utf8", $this->user, $this->password);
            return $pdo;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Función que sirve para registrar un usuario. Recibe los parametros los datos del usuario.
     * @param type $name string
     * @param type $surname string
     * @param type $email string
     * @param type $phone string
     * @param type $password string
     * @param type $rol string
     */
    function registerUser($name, $surname, $email, $phone, $password, $rol = '2', $state = '1') {

        try {
            $sql = "insert into Usuarios (nombre,apellido,email,telefono,password,rol_usuario,estado) values(?,?,?,?,?,?,?)";

            $db = $this->pdo;

            $db->beginTransaction();

            if (($smtp = $db->prepare($sql))) {

                $smtp->bindValue(1, $name, \PDO::PARAM_STR);
                $smtp->bindValue(2, $surname, \PDO::PARAM_STR);
                $smtp->bindValue(3, $email, \PDO::PARAM_STR);
                $smtp->bindValue(4, $phone, \PDO::PARAM_STR);
                $smtp->bindValue(5, $password, \PDO::PARAM_STR);
                $smtp->bindValue(6, $rol, \PDO::PARAM_STR);
                $smtp->bindValue(7, $state, \PDO::PARAM_STR);

                $smtp->execute();
            }
            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function updateAccess($id) {
        try {
            $sql = "update Usuarios set fecha_ultimo_acceso = now() where id = ?;";

            $db = $this->pdo;

            $db->prepare($sql);

            if (($smtp = $db->prepare($sql))) {

                $smtp->bindValue(1, $id, \PDO::PARAM_INT);

                $smtp->execute();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getUserData($userId) {
        try {
            $sql = "select u.id, u.nombre, u.apellido, u.email, u.telefono, u.direccion, u.ciudad, u.codigo_postal, u.provincia, u.imagen, u.password,u.rol_usuario, r.nombre_rol "
                    . "from Usuarios as u "
                    . "inner join Roles as r on u.rol_usuario = r.id"
                    . " where u.id = :userId";

            $db = $this->pdo;

            $consult = $db->prepare($sql);

            $consult->bindParam(':userId', $userId);

            $consult->execute();

            $result = $consult->fetch(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function loginUser($emailLogin) {

        try {
            $sql = "select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, estado from Usuarios where email = :emailUser";

            $db = $this->pdo;

            $consult = $db->prepare($sql);

            $consult->bindParam(':emailUser', $emailLogin);

            $consult->execute();

            $result = $consult->fetch(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function sendMailConfirmationRegister($id_user) {

        try {

            $db = $this->pdo;

            $sql = 'select nombre, email from Usuarios where id = ?;';

            $db->beginTransaction();

            if ($result = $db->prepare($sql)) {

                $result->bindValue(1, $id_user, \PDO::PARAM_STR);

                $result->execute();

                while ($row = $result->fetch()) {
                    $user_name = $row['nombre'];
                    $email = $row['email'];
                }
            }

            $mail = new email();
            $mail->sendEmail($email, "<h1>Confirmación de registro " . $user_name . "</h1>", "Enhorabuena, te has registrado satisfactoriamente en nuestra página Panaderia M.L.!");
            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function getLastUserId() {

        $db = $this->pdo;

        try {

            $sql = 'select max(id) from Usuarios;';

            if ($result = $db->prepare($sql)) {

                $result->execute();

                if ($row = $result->fetch()) {
                    $userId = $row;
                }
            }

            return $userId[0];
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function updateAccountUser($id_user, $name, $surname, $email, $phone, $pwd, $ruteImg) {


        $sql = "update Usuarios set nombre= ?, apellido= ?, email= ?, telefono= ?,password=?, imagen=? where id = ?;";

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            $db->prepare($sql);

            if (($smtp = $db->prepare($sql))) {

                $smtp->bindValue(1, $name, \PDO::PARAM_STR);
                $smtp->bindValue(2, $surname, \PDO::PARAM_STR);
                $smtp->bindValue(3, $email, \PDO::PARAM_STR);
                $smtp->bindValue(4, $phone, \PDO::PARAM_STR);
                $smtp->bindValue(5, $pwd, \PDO::PARAM_STR);
                $smtp->bindValue(6, $ruteImg, \PDO::PARAM_STR);
                $smtp->bindValue(7, $id_user, \PDO::PARAM_STR);

                $smtp->execute();
            }
            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function updateAddressUser($address, $city, $postalCode, $province, $idUser) {

        $sql = "update Usuarios set direccion= ?, ciudad=?, codigo_postal= ?, provincia= ? where id = ?;";

        $db = $this->pdo;

        try {
            $db->beginTransaction();

            $db->prepare($sql);

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $address);
                $smtp->bindValue(2, $city);
                $smtp->bindValue(3, $postalCode);
                $smtp->bindValue(4, $province);
                $smtp->bindValue(5, $idUser);

                $smtp->execute();
            }
            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function deleteImgUser($img, $idUser) {

        $sql = 'update Usuarios set imagen =? where id =?';

        $db = $this->pdo;

        try {
            $db->beginTransaction();

            $db->prepare($sql);

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $img);
                $smtp->bindValue(2, $idUser);

                $smtp->execute();
            }
            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function deleteAccountUser($idUser) {

        $sql = 'update Usuarios set estado = 2 where id =?';

        $db = $this->pdo;

        try {
            $db->beginTransaction();

            $db->prepare($sql);

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $idUser);

                $smtp->execute();
            }
            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function listRegisteredUsers() {
        $array = array();
        $db = $this->pdo;
        $sql = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, fecha_registro, fecha_ultimo_acceso from Usuarios';
        try {

            foreach ($result = $db->query($sql) as $row) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function checkUserDB($email) {

        $sql = 'select * from Usuarios where email = ?;';
        $db = $this->pdo;
        try {

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $email, \PDO::PARAM_STR);

                $smtp->execute();

                if ($row = $smtp->fetch(\PDO::FETCH_ASSOC)) {
                    $result = $row;
                }
            }
            return $result;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function load_img($id) {

        $sql = 'select * from Imagenes where id = ?;';
        $db = $this->pdo;

        try {
            if ($smtp = $db->prepare($sql)) {
                $smtp->bindValue(1, $id, \PDO::PARAM_STR);
                $smtp->execute();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /*
     * Función que carga todas las categorias que haya en la bd. Este función se llama en el formulario para dar de alta un producto, en el panel del administrador.
     * Devuelve un array con los codigos y los nombres de las categorias.
     */

    function load_categories() {

        $arrayCategorias = array();

        $sql = 'select * from Categorias';

        $db = $this->pdo;

        try {
            if ($smtp = $db->prepare($sql)) {
                $smtp->execute();

                while ($row = $smtp->fetch()) {

                    $arrayCategorias[] = $row;
                }
            }
            return $arrayCategorias;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Función que recibe los valores necesarios por parametros para dar de alta un nuevo producto. Esta función se llama en el fichero uploadProduct. Los valores se reciben de un formulario 
     * desde el panel del administrador.
     * @param String $name_product
     * @param String $description
     * @param String $price
     * @param Sting $amount
     * @param string $categories
     * @param String $img
     */
    function uploadNewProduct($name_product, $description, $price, $amount, $categorie, $typeProduct, $ruteImg) {


        $sql = 'insert into Productos (nombre,descripcion,precio,cantidad,tipo_producto) values (?,?,?,?,?)';
        $sql2 = 'select max(id) from Productos';
        $sql3 = 'insert into Categorias_productos (id_producto,id_categoria) values (?,?)';
        $sql4 = 'insert into Imagenes (ruta) values (?)';
        $sql5 = 'select max(id) from Imagenes';
        $sql6 = 'insert into Productos_Imagenes (id_imagen,id_producto) values (?,?)';

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            if ($smtp = $db->prepare($sql)) {
                $smtp->bindValue(1, $name_product, \PDO::PARAM_STR);
                $smtp->bindValue(2, $description, \PDO::PARAM_STR);
                $smtp->bindValue(3, $price, \PDO::PARAM_STR);
                $smtp->bindValue(4, $amount, \PDO::PARAM_STR);
                $smtp->bindValue(5, $typeProduct, \PDO::PARAM_STR);
                $smtp->execute();
            }

            if ($result = $db->prepare($sql2)) {

                $result->execute();

                $row = $result->fetch();

                $idNewProduct = $row[0];
            }


            if ($stp = $db->prepare($sql3)) {

                $stp->bindValue(1, $idNewProduct);
                $stp->bindValue(2, $categorie);
                $stp->execute();
            }


            if ($res = $db->prepare($sql4)) {

                $res->bindValue(1, $ruteImg);
                $res->execute();
            }

            if ($r = $db->prepare($sql5)) {

                $r->execute();

                $fila = $r->fetch();

                $idNewImg = $fila[0];
            }

            if ($resultado = $db->prepare($sql6)) {

                $resultado->bindValue(1, $idNewImg);
                $resultado->bindValue(2, $idNewProduct);
                $resultado->execute();
            }



            $db->commit();
        } catch (\Exception $ex) {
            $db->rollBack();
            echo $ex->getMessage();
        }
    }

    /**
     * Función que devuelve todos los productos, pero limitados por los valores del limit en la sentencia sql, en este caso los valores limites son las variables que recibe como parametro.
     * Esta función es llamada para crear el paginado en el panel del administrador, para mostrar todos los productos que hay en la base de datos.
     * @param type $start
     * @param type $offset
     * @return type
     */
    function getAllProducts($start, $offset) {


        $db = $this->pdo;
        $sql = 'select p.id, p.nombre, p.descripcion, p.precio, p.cantidad, c.nombre_categoria from Productos as p inner join Categorias_productos as cp on p.id = cp.id_producto inner join Categorias as c on c.id = cp.id_categoria order by p.id asc LIMIT :start,:ofset';
        try {

            $result = $db->prepare($sql);

            $result->bindParam(':ofset', $offset, \PDO::PARAM_INT);
            $result->bindParam(':start', $start, \PDO::PARAM_INT);
            $result->execute();

            $products = $result->fetchAll();

            return $products;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getProductById($id_product) {
        $array = array();
        $db = $this->pdo;
        $sql = 'select p.id, p.nombre, p.descripcion, p.precio, p.cantidad, p.tipo_producto, c.nombre_categoria, i.id from Productos as p inner join Categorias_productos as cp on p.id = cp.id_producto inner join Categorias as c on c.id = cp.id_categoria inner join Productos_Imagenes as pi on p.id = pi.id_producto inner join Imagenes as i on pi.id_imagen = i.id where p.id = ?';
        try {

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $id_product);
                $smtp->execute();
                while ($result = $smtp->fetch()) {
                    array_push($array, $result);
                }
            }
            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function countProducts() {

        $sql = 'select count(*) from Productos';

        $db = $this->pdo;

        try {

            $stmt = $db->query($sql);
            $count = $stmt->fetchColumn();
            return $count;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Función que actualiza un producto existente. Todos los campos que recibe contienen valor, salvo la ruta de la imagen que puede tener o no valor.
     * @param type $idProduct
     * @param type $nameProduct
     * @param type $description
     * @param type $price
     * @param type $amount
     * @param type $categorie
     * @param type $img
     */
    function updateProduct($idProduct, $nameProduct, $description, $price, $amount, $categorie, $categories, $ruteImage) {

        $idImg = "";
        $sql1 = 'update Productos set nombre = ?, descripcion= ?, precio= ?, cantidad= ? where id = ?;';
        $sql2 = 'update Categorias_productos set id_categoria= ? where id_producto = ?';
        $sql3 = 'select * from Imagenes as i inner join Productos_Imagenes as pi on pi.id_imagen = i.id where pi.id_producto = ?;';
        $sql4 = 'update Imagenes set ruta= ? where id = ?;';
        $sql5 = 'select id_categoria from Categorias_productos where id_producto = ?';
        $sql6 = 'insert into Categorias_productos(id_producto,id_categoria) values (?,?)';
        $sql7 = 'delete from Categorias_productos where id_producto = ? and id_categoria = ?';

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            if ($result1 = $db->prepare($sql1)) {

                $result1->bindValue(1, $nameProduct);
                $result1->bindValue(2, $description);
                $result1->bindValue(3, $price);
                $result1->bindValue(4, $amount);
                $result1->bindValue(5, $idProduct);
                $result1->execute();
            }

            if ($result2 = $db->prepare($sql2)) {
                $result2->bindValue(1, $categorie);
                $result2->bindValue(2, $idProduct);
                $result2->execute();
            }

            if ($categories != null) {

                foreach ($categories as $v) {

                    if ($result = $db->prepare($sql5)) {

                        $result->bindValue(1, $idProduct);
                        $result->execute();

                        while ($row = $result->fetch()) {

                            if ($row['id_categoria'] == $v && $row['id_categoria'] != $categorie) {

                                $res = $db->prepare($sql2);
                                $res->bindValue(1, $v);
                                $res->bindValue(2, $idProduct);
                                $res->execute();
                            }
                            if ($row['id_categoria'] != $v && $row['id_categoria'] != $categorie) {

                                $r = $db->prepare($sql6);
                                $r->bindValue(1, $idProduct);
                                $r->bindValue(2, $v);
                                $r->execute();
                            }

                            if ($row['id_categoria'] != $v && $row['id_categoria'] == $row['id_categoria']) {

                                $r = $db->prepare($sql6);
                                $r->bindValue(1, $idProduct);
                                $r->bindValue(2, $v);
                                $r->execute();
                            }
                        }
                    }
                }
            } else {
                if ($consulta = $db->prepare($sql5)) {

                    $consulta->bindValue(1, $idProduct);
                    $consulta->execute();

                    while ($fila = $consulta->fetch()) {

                        if ($fila['id_categoria'] > '2') {

                            $delete = $db->prepare($sql7);
                            $delete->bindValue(1, $idProduct);
                            $delete->bindValue(2, $fila['id_categoria']);
                            $delete->execute();
                        }
                    }
                }


                if ($ruteImage != "") {

                    if ($result3 = $db->prepare($sql3)) {

                        $result3->bindValue(1, $idProduct);
                        $result3->execute();

                        $row = $result3->fetch();

                        $idImg = $row[0];
                    }


                    if ($result4 = $db->prepare($sql4)) {

                        $result4->bindValue(1, $ruteImage);
                        $result4->bindValue(2, $idImg);
                        $result4->execute();
                    }
                }
            }

            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function deleteCategorie($idCategorie) {

        $sql = 'delete from Categorias_productos where id_categoria = ?';
        $sql2 ='delete from Categorias where id = ?';
        
        $db = $this->pdo;

        try {
            
            $db->beginTransaction();
            
            if($idCategorie > 2){
                
                if($stmt = $db->prepare($sql)){
                  
                  $stmt->bindValue(1, $idCategorie);
                  $stmt->execute();
                                     
                }
                
                if($result= $db->prepare($sql2)){
                    
                    $result->bindValue(1, $idCategorie);
                    $result->execute();
                }
                
            }
            
                  
            
             $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function adminSearchProduct($dato) {

        $dataProduct = array();

        $sql = 'select p.id, p.nombre, p.descripcion, p.precio, p.cantidad, p.tipo_producto, c.nombre_categoria from Productos as p '
                . 'inner join Categorias_productos as cp on cp.id_producto = p.id inner join Categorias as c on c.id = cp.id_categoria'
                . ' where p.id = ?;';

        $sql2 = 'select p.id, p.nombre, p.descripcion, p.precio, p.cantidad, p.tipo_producto, c.nombre_categoria from Productos as p '
                . 'inner join Categorias_productos as cp on cp.id_producto = p.id inner join Categorias as c on c.id = cp.id_categoria'
                . ' where p.nombre like ?;';

        $db = $this->pdo;

        try {

            if (is_numeric($dato)) {

                if ($smtp = $db->prepare($sql)) {

                    $smtp->bindValue(1, $dato);
                    $smtp->execute();
                    while ($result = $smtp->fetch()) {
                        array_push($dataProduct, $result);
                    }

                    return $dataProduct;
                }
            } else {

                if ($smtp = $db->prepare($sql2)) {

                    $param = array("$dato%");

                    $smtp->execute($param);

                    while ($result = $smtp->fetch()) {
                        array_push($dataProduct, $result);
                    }

                    return $dataProduct;
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function deleteProduct($idProduct) {

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function getAllCategories() {

        $array = array();
        $db = $this->pdo;
        $sql = 'select id, nombre_categoria from Categorias;';
        try {

            foreach ($result = $db->query($sql) as $row) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function addCategorie($nameCategorie) {

        $sql = 'insert into Categorias (nombre_categoria) values (?)';

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $nameCategorie);

                $smtp->execute();
            }

            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function getCategorieById($idCategorie) {

        $sql = 'select nombre_categoria from Categorias where id = ?;';

        $db = $this->pdo;

        try {
            if ($result = $db->prepare($sql)) {
                $result->bindValue(1, $idCategorie);
                $result->execute();
            }

            while ($row = $result->fetch()) {

                $nameCategorie = $row[0];
            }

            return $nameCategorie;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Función que actualiza los datos de una categoría, recibe por parametros el id de la categoria y el nombre a actualziar.
     * @param String $idCategorie 
     * @param String $nameCategorie
     */
    function updateCategorie($idCategorie, $nameCategorie) {

        $sql = 'update Categorias set nombre_categoria = ? where Categorias.id = ?';

        $db = $this->pdo;

        try {

            if ($result = $db->prepare($sql)) {

                $result->bindValue(1, $nameCategorie);
                $result->bindValue(2, $idCategorie);
                $result->execute();
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function addNewAdmin($email) {

        $sql = 'update Usuarios set rol_usuario = 1 where email = ?';

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $email, \PDO::PARAM_STR);
                $smtp->execute();
            }

            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function getIdAdminByEmail($email) {

        $sql = 'select id from Usuarios where email = ?;';

        $db = $this->pdo;

        try {

            if ($result = $db->prepare($sql)) {
                $result->bindValue(1, $email);
                $result->execute();
            }

            while ($row = $result->fetch()) {

                $idUser = $row[0];
            }

            return $idUser;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function removeAdmin($id) {

        $sql = 'update Usuarios set rol_usuario = 2 where id = ?';

        $db = $this->pdo;

        try {

            $db->beginTransaction();

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $id);
                $smtp->execute();
            }

            $db->commit();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $db->rollBack();
        }
    }

    function getAllAdmins() {

        $array = array();

        $sql = 'select id, nombre, email from Usuarios where rol_usuario = 1 order by id';

        $db = $this->pdo;

        try {

            foreach ($db->query($sql) as $row) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function searchAdmin($admin) {

        $array = array();

        $sql = 'select id, nombre, email from Usuarios where id = ?;';
        $sql2 = 'select id, nombre, email from Usuarios where email like ?;';

        $db = $this->pdo;

        try {

            if (is_numeric($admin)) {

                if ($smtp = $db->prepare($sql)) {

                    $smtp->bindValue(1, $admin);
                    $smtp->execute();

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }
                }
                return $array;
            } else {

                if ($smtp = $db->prepare($sql2)) {

                    $param = array("$admin%");
                    $smtp->execute($param);

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }

                    return $array;
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function searchUserActive($user) {

        $array = array();

        $sql = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, fecha_registro, fecha_ultimo_acceso, estado from Usuarios where estado = 1 and id = ?;';
        $sql2 = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, fecha_registro, fecha_ultimo_acceso, estado from Usuarios where email like ? and estado = 1;';

        $db = $this->pdo;

        try {

            if (is_numeric($user)) {

                if ($smtp = $db->prepare($sql)) {

                    $smtp->bindValue(1, $user, \PDO::PARAM_STR);
                    $smtp->execute();

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }
                }
                return $array;
            } else {

                if ($smtp = $db->prepare($sql2)) {

                    $param = array("$user%");
                    $smtp->execute($param);

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }

                    return $array;
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function searchUserDeleted($user) {

        $array = array();

        $sql = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, fecha_registro, fecha_ultimo_acceso, estado from Usuarios where estado = 2 and id = ?;';
        $sql2 = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, fecha_registro, fecha_ultimo_acceso, estado from Usuarios where email like ? and estado = 2;';

        $db = $this->pdo;

        try {

            if (is_numeric($user)) {

                if ($smtp = $db->prepare($sql)) {

                    $smtp->bindValue(1, $user, \PDO::PARAM_STR);
                    $smtp->execute();

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }
                }
                return $array;
            } else {

                if ($smtp = $db->prepare($sql2)) {

                    $param = array("$user%");
                    $smtp->execute($param);

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }

                    return $array;
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function searchUpdateByDate($date1, $date2) {

        $array = array();
        $db = $this->pdo;

        $sql_1 = 'select * from Usuarios_actualizados where fecha_modificacion between :fecha1 and :fecha2 order by fecha_modificacion desc';
        $sql_2 = 'select * from Usuarios_actualizados where fecha_modificacion = ?';

        try {

            if ($date1 != "" && $date2 != "") {

                if ($stmt = $db->prepare($sql_1)) {
                    $stmt->bindParam(':fecha1', $date1);
                    $stmt->bindValue('fecha2', $date2);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {

                        array_push($array, $row);
                    }
                    return $array;
                }
            }

            if ($date1 != "" && $date2 == "") {

                if ($smtp = $db->prepare($sql_2)) {
                    $smtp->bindValue(1, $date1, \PDO::PARAM_STR);
                    $smtp->execute();

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }
                    return $array;
                }
            }

            if ($date2 != "" && $date1 == "") {

                if ($smtp = $db->prepare($sql_2)) {
                    $smtp->bindValue(1, $date2, \PDO::PARAM_STR);
                    $smtp->execute();

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }
                    return $array;
                }
            }

            if ($date2 === $date1) {

                if ($smtp = $db->prepare($sql_2)) {
                    $smtp->bindValue(1, $date2, \PDO::PARAM_STR);
                    $smtp->execute();

                    while ($row = $smtp->fetch()) {

                        array_push($array, $row);
                    }
                    return $array;
                }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function countUsers() {

        $sql = 'select count(*) from Usuarios';

        $db = $this->pdo;

        try {

            $stmt = $db->query($sql);
            $total = $stmt->fetchColumn();
            return $total;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getAllUsersActives($start, $offset) {

        $db = $this->pdo;
        $sql = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, fecha_registro, fecha_ultimo_acceso, estado from Usuarios where estado = 1 order by id asc LIMIT :start,:ofset';
        try {

            $result = $db->prepare($sql);

            $result->bindParam(':ofset', $offset, \PDO::PARAM_INT);
            $result->bindParam(':start', $start, \PDO::PARAM_INT);
            $result->execute();

            $users = $result->fetchAll();

            return $users;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function countUpdatesUsers() {

        $sql = 'select count(*) from Usuarios_actualizados';

        $db = $this->pdo;

        try {

            $stmt = $db->query($sql);
            $total = $stmt->fetchColumn();
            return $total;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getUpdatesUsers($start, $offset) {

        $db = $this->pdo;
        $sql = 'select anterior_nombre, anterior_apellido, anterior_email, anterior_telefono, anterior_direccion, anterior_ciudad, anterior_codigo_postal, anterior_provincia, anterior_imagen, anterior_password, anterior_fecha_registro, nuevo_nombre, nuevo_apellido, nuevo_email, nuevo_telefono, nueva_direccion, nueva_ciudad, nuevo_codigo_postal, nueva_provincia, nueva_imagen, nueva_password, nueva_fecha,usuario, fecha_modificacion from Usuarios_actualizados order by fecha_modificacion desc LIMIT :start,:ofset';
        try {

            $result = $db->prepare($sql);

            $result->bindParam(':ofset', $offset, \PDO::PARAM_INT);
            $result->bindParam(':start', $start, \PDO::PARAM_INT);
            $result->execute();

            $users = $result->fetchAll();

            return $users;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getImgUser($userId) {

        $sql = 'select imagen from Usuarios where id = ?';
        $db = $this->pdo;

        try {

            if ($smtp = $db->prepare($sql)) {

                $smtp->bindValue(1, $userId);
                $smtp->execute();
            }

            while ($row = $smtp->fetch()) {

                $img = $row[0];
            }

            return $img;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getUsersDeleted($start, $offset) {

        $sql = 'select id, nombre, apellido, email, telefono, direccion, ciudad, codigo_postal, provincia, imagen, password, rol_usuario, fecha_registro, fecha_ultimo_acceso, estado from Usuarios where estado = 2 LIMIT :start,:ofset';
        $db = $this->pdo;

        try {

            if ($result = $db->prepare($sql)) {

                $result->bindParam(':ofset', $offset, \PDO::PARAM_INT);
                $result->bindParam(':start', $start, \PDO::PARAM_INT);
                $result->execute();

                $users = $result->fetchAll();

                return $users;
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getTotalUsersDeleted() {

        $sql = 'select count(*) from Usuarios where estado = 2';

        $db = $this->pdo;

        try {

            $stmt = $db->query($sql);
            $total = $stmt->fetchColumn();
            return $total;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getAllProductsPastry() {

        $sql = 'select * from Productos where tipo_producto = 1';

        $db = $this->pdo;

        $array = array();

        try {

            $smtp = $db->query($sql);

            while ($row = $smtp->fetch()) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getAllProductsBakery() {

        $sql = 'select * from Productos where tipo_producto = 2';

        $db = $this->pdo;

        $array = array();

        try {

            $smtp = $db->query($sql);

            while ($row = $smtp->fetch()) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getImgfromProductsBakery() {

        $sql = 'select i.ruta, p.id from Productos as p inner join productos_imagenes as pi on pi.id_producto = p.id left join imagenes as i on i.id = pi.id_imagen where p.tipo_producto = 2 order by p.id';

        $db = $this->pdo;

        $array = array();

        try {

            $smtp = $db->query($sql);

            while ($row = $smtp->fetch()) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getImgfromProductsPastry() {

        $sql = 'select i.ruta, p.id from Productos as p inner join productos_imagenes as pi on pi.id_producto = p.id left join imagenes as i on i.id = pi.id_imagen where p.tipo_producto = 1 order by p.id';

        $db = $this->pdo;

        $array = array();

        try {

            $smtp = $db->query($sql);

            while ($row = $smtp->fetch()) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getAllProductsByIdCategorie($codCategorie) {

        $sql = 'select * from Productos as p inner join Categorias_productos as cp on p.id = cp.id_producto where cp.id_categoria = ?';

        $db = $this->pdo;

        $array = array();

        try {

            $smtp = $db->prepare($sql);
            $smtp->bindValue(1, $codCategorie);
            $smtp->execute();

            while ($row = $smtp->fetch()) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getImgByCodCateorie($codCateorie) {

        $sql = 'select p.id, i.ruta from Productos as p inner join Categorias_productos as cp on p.id = cp.id_producto inner join Productos_Imagenes as pi on p.id = pi.id_producto inner join Imagenes as i on i.id = pi.id_imagen where cp.id_categoria = ?';

        $db = $this->pdo;

        $array = array();

        try {

            $smtp = $db->prepare($sql);

            $smtp->bindValue(1, $codCateorie);
            $smtp->execute();

            while ($row = $smtp->fetch()) {

                array_push($array, $row);
            }

            return $array;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

}

?>