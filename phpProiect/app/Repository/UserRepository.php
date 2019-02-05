<?php

namespace App\Repository;

use Framework\Db;
use App\Models\User;


class UserRepository{

    protected $db;

    function __construct(){
        $this->db = Db::getInstance();
    }

    public function create($user){
        try {

            $null = null;
            $req = $this->db->prepare('INSERT INTO users(username,password,email) VALUES(:username, :password, :email)');
            $req->bindParam(':username', $user->getUsername());
            $req->bindParam(':password', md5($user->getPassword()));
            $req->bindParam(':email', $user->getEmail());

            $req->execute();
        } catch (PDOException $e) {

        }
    }

    public function getUserById($userId){

         $req = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $req->execute(array('id' => $userId));
        $res = $req->fetch();

        $user = User::getModel($res);

        return $user;
    }

    public function checkLogin($email,$password){
        $req = $this->db->prepare('SELECT * FROM users WHERE email = :email  && password= :password');
        var_dump($email,md5($password));
        $req->execute(array('email' => $email,'password' => md5($password)));
        $res = $req->fetch();
        if($res){
            return User::getModel($res);
        }
        return false;
    }

    public function edit($user){
        try {

            $req = $this->db->prepare('UPDATE users set username= :username,
            password= :password WHERE id= :id');
            $req->bindParam(':id', $_SESSION['logged']);
            $req->bindParam(':username', $user->getUsername());
            $req->bindParam(':password', md5($user->getPassword()));
           
            $req->execute();
        } catch (PDOException $e) {

        }
    }

}