<?php

PDOConnexion::setParameters("", "", "");

class Album{

    private $AlbumId;
    private $Title;
    private $ArtistId;
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

    public static function getAllAlbums(int $page = 0) {
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Album LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getAlbum(int $id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Album WHERE AlbumId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
        $sth->execute();
        return $sth->fetch();
    }

    public static function getAlbumsFromGenre(int $genreId, int $page){
        $db = PDOConnexion::getInstance();
        $sql="SELECT DISTINCT a.* FROM Album as a JOIN Track as t ON a.AlbumId = t.AlbumId WHERE t.GenreId = :id LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $genreId, PDO::PARAM_INT);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Album');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getTracks(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Track WHERE AlbumId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->AlbumId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Track');
        $sth->execute();
        return $sth->fetchAll();
    }

}