<?php

namespace user;

class user implements \JsonSerializable {

    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $address;
    private $city;
    private $cp;
    private $province;
    private $img;
    private $rol;
    private $state;

    public function __construct($id, $name, $surname, $email, $phone, $address, $city, $cp, $province, $img, $rol, $state) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->city = $city;
        $this->cp = $cp;
        $this->province = $province;
        $this->img = $img;
        $this->rol = $rol;
        $this->state = $state;
    }

    public function __get($var) {
        if (property_exists($this, $var)) {
            return $this->$var;
        }
    }

    public function __set($var, $value) {
        $this->$var = $value;
    }

    public function jsonSerialize() {
        return [
        'id' => $this->id,
        'nombre' => $this->name,
        'apellido' => $this->surname,
        'email' => $this->email,
        'telefono' => $this->phone,
        'direccion' => $this->address,
        'ciudad' => $this->city,
        'codigo_postal' => $this->cp,
        'provincia' => $this->province,
        'img' => $this->img,
        'rol' => $this->rol,
        'estado' => $this->state
        ];
    }

}

?>