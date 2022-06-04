<?php

namespace order;

class order {
    
    private $numOrder;
    private $user;
    private $date_order;
    private $id_product;
    
    public function __construct($numOrder, $user, $date_order, $id_product) {
        $this->numOrder = $numOrder;
        $this->user = $user;
        $this->date_order = $date_order;
        $this->id_product = $id_product;
    }

    public function __get($name) {
        if(property_exists($this, $name)){
            return $this->$name;
        }
    }
   
    public function __set($var, $value) {
        $this->$var = $value;   
    }
    
}

?>
