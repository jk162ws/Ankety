<?php
require_once('Entity.php');
class Poll extends Entity {
    
    private $name;
    private $questions;
    private $type;
    private $password;
    
    public function __construct($name, $questions, $type, $password) {
        $this->name = $name;
        $this->questions = $questions;
        $this->type = $type;
        $this->password = $password;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getQuestions() {
        return $this->questions;
    }
    
    public function setQuestions($questions) {
        $this->questions = $questions;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
}
