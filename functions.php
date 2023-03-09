<?php
class Member
{
    public $name;
    public $mail;
    public $phone;
    public $address;
    public $cin;
    public $date;
    public $occupation;
    public $nickname;

    public function __construct($name, $mail, $address, $phone, $cin, $date, $occupation, $nickname)
    {
        $this->name = $name;
        $this->mail = $mail;
        $this->address = $address;
        $this->phone = $phone;
        $this->cin = $cin;
        $this->date = $date; 
        $this->occupation = $occupation;
        $this->nickname = $nickname;
    }
    public function hash_pass($password)
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        return $password_hash;
    }
    public function check_member($mail){
        if (strpos($mail,"admin")==0 & strpos($mail, "choise") == 8) {
            return true;
        }else{
            return false;
        }
    }

}

?>