<?php

namespace product;

class product {

    private $id;
    private $nameProduct;
    private $price;
    private $amount;

    public function __construct($id, $nameProduct, $price, $amount) {
        $this->id = $id;
        $this->nameProduct = $nameProduct;
        $this->price = $price;
        $this->amount = $amount;
    }

    public function __get($var) {
        if (property_exists($this, $var)) {
            return $this->$var;
        }
    }

    public function __set($var, $value) {
        $this->$var = $value;
    }

}

?>
