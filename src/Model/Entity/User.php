<?php

namespace App\Model\Entity;

class User {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    function fromSQL($row) {
        $this->id = $row['id'];
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->email = $row['email'];
        $this->password = $row['password'];
    }
}