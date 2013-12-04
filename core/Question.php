<?php
class Question extends Entity {
    
    private $text;
    private $type;
    private $image;
    private $questionOptions;
    private $answers;
    
    public function __construct($text, $type, $questionOptions, $image) {
        $this->text = $text;
        $this->type = $type;
        $this->questionOptions = $questionOptions;
        $this->image = $image;
    }
    
    public function getQuestionText() {
        return $this->text;
    }
    
    public function getQuestionType() {
        return $this->type;
    }
    
    public function getImage() {
        return $this->image;
    }
    
    public function getQuestionOptions() {
        return $this->questionOptions;
    }
    
    public function setQuestionText($text) {
        $this->text = $text;
    }

    public function setQuestionType($type) {
        $this->type = $type;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setQuestionOptions($answers) {
        $this->questionOptions = $answers;
    }

    public function getQuestionAnswers() {
        return $this->answers;
    }

    public function setQuestionAnswers($answers) {
        $this->answers = $answers;
    }

}
