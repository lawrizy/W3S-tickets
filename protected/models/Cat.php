<?php


class Cat {
    private $_id;
    private $_label;
    
    public function get_id() { return $this->_id; }
    public function get_label() { return $this->_label; }
    public function set_id($_id) { $this->_id = $_id; }
    public function set_label($_label) { $this->_label = $_label; }

    public function __construct($id, $label) {
        $this->id = $id;
        $this->label = $label;
    }
    
    
    public function __toString() {
        return $this->id . ' ' . $this->label;
    }

}
