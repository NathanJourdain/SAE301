<?php

PDOConnexion::setParameters("", "", "");

class Artist{

    private $ArtistId;
    private $Name;
    private $Image;


    public function __construct(array $arguments = []){
        foreach($arguments as $key=>$value){
            $this->$key = $value;
        }
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __toString(){
        $str = "";
        foreach($this as $key=>$value)
            $str.="$key : $value // ";
        return $str;
    }

    public static function getAllArtists(int $page = 1){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Artist LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Artist');
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getArtistsByLetter(string $letter){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Artist WHERE LEFT(Name, 1) = :letter";
        $sth = $db->prepare($sql);
        $sth->bindValue(":letter", $letter, PDO::PARAM_STR);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Artist');
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getArtist(int $id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Artist WHERE ArtistId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Artist');
        $sth->execute();
        return $sth->fetch();
    }

    public function getAlbums(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Album WHERE ArtistId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->ArtistId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
        $sth->execute();
        return $sth->fetchAll();
    }

    
}