<?php

class adéherent
{
    public $Nicname;
    public $fullname;
    public $cin;
    public $email;
    public $birthdate;
    public $occupation;
    public $phone;
    public function __construct($Nicname, $fullname, $cin, $email, $birthdate, $occupation, $phone)
    {
        $this->birthdate = $birthdate;
        $this->Nicname = $Nicname;
        $this->cin = $cin;
        $this->email = $email;
        $this->occupation = $occupation;
        $this->phone = $phone;
        $this->fullname = $fullname;
    }
    public function password($password)
    {
        $hashvalue = password_hash($password, PASSWORD_DEFAULT);
        return $hashvalue;
    }
    public function ROLE($Nicname)
    {
        if (strpos($Nicname, "HH") == 3) {
            return true;
        } else {
            return false;

        }

    }

}













?>