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

class Reservation {
    public $reservation_date;
    public $id_book;
    public $id_member;
    public function __construct($reservation_date,$id_book,$id_member){
        $this->id_book = $id_book;
        $this->reservation_date = $reservation_date;
        $this->id_member = $id_member;
    }
}

?>