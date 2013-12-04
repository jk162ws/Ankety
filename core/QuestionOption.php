<?php
require_once('Entity.php');
class QuestionOption extends Entity {
    
    private $text;
    
    public function __construct($text) {
        $this->text = $text;
    }
    
    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }
    
}
