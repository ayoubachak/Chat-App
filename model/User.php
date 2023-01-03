<?php 

class User {
    private $id;
    private $username;
    private $password;
    private $profileImage;
    private $lastLogin;
    private $dateOfBirth;

    public function __construct($id=null, $username=null, $password=null, $profileImage=null, $lastLogin=null, $dateOfBirth=null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->profileImage = $profileImage;
        $this->lastLogin = $lastLogin;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getProfileImage() {
        return $this->profileImage;
    }

    public function setProfileImage($profileImage) {
        $this->profileImage = $profileImage;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }
}
