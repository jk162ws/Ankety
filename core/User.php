<?php
require_once('Entity.php');
class User extends Entity {
    
    private $login;
    private $email;
    private $password;
    private $Polls;
    
    public function __construct($login, $email, $password, $Polls) {
        $this->login = $login;
        $this->email = $email;
        $this->Polls = $Polls;
        $this->password = $password;
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPolls() {
        return $this->Polls;
    }
    
    public function addElelementToArray($Poll) {
        array_push($this->Polls, $Poll);
    }
    
    public function removeElementFromArray($PollId) {
        unset($this->Polls[$PollId]);
        $this->Polls = array_values($this->Polls);
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPolls($Polls) {
        $this->Polls = $Polls;
    }


}

