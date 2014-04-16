<?php

class CategorieAndroid {
    
    private $label;
    private $id;

    public function get_label() { return $this->label; }
    public function set_label($_label) { $this->label = $_label; }
    public function get_id() { return $this->id; }
    public function set_id($_id) { $this->id = $_id; }

    function __construct($_label, $_id) {
        $this->label = $_label;
        $this->id = $_id;
    }

}