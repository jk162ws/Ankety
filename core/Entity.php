<?php
class Entity {
    
    protected $id;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function addElelementToArray($array, $element) {
        if($array == null) {
            $array = [$element];
        } else {
            array_push($array, $element);
        }
        return $array;
    }
    
    public function removeElementFromArray($array, $element_id) {
        unset($array[$element_id]);
        $array = array_values($array);
    }
    
}
