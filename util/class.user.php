<?php

class User {

    var $username;
    var $id;
    var $email;
    
    function __construct($inUsername, $inPass) {
        
        $pass = SHA1(strtoupper($inUsername).":".strtoupper($inPass));
        
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASSWORD);

        //check if the account exists, retrieving info if it does
        $hash = SHA1(strtoupper($inUsername).":".strtoupper($inPass));
        $qry = $db->prepare("SELECT id, username, email FROM users WHERE username = ? && password = ?");
        $qry->execute(array($inUsername, $hash));
        $row = $qry->fetch(PDO::FETCH_ASSOC);
        
        if ($row != false) {
            $this->username = $row["username"];
            $this->id = $row["id"];
            $this->email = $row["email"];
            $_SESSION["user"] = $this; //php auto serializes
        }
        else {
            throw new LoginException('Incorrect Username or Password.');
        }
    }
    
    /*public function __sleep()
    {
        return array_keys(get_object_vars($this));
    }*/
    
    function getUsername() {
        return $this->username;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function getId() {
        return $this->id;
    }
    
    function addMeme($title, $topText, $bottomText, $path) {
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASSWORD);

        //check if the account exists, retrieving info if it does
        $qry = $db->prepare("INSERT INTO memes (user_id, title, header, footer, path, date) VALUES(?, ?, ?, ?, ?, NOW())");
        if ($qry->execute(array($this->id, $title, $topText, $bottomText, $path)))
            return $db->lastInsertId();
        else
            throw new LoginException( "".var_dump($qry->errorInfo())." ");
    }
    
    //TODO
    function changePass($oldPass, $newPass) {
    }
    
    //TODO
    function changeEmail($pass, $oldEmail, $newEmail) {
        //some form of confirmation system?
    }
    
}
