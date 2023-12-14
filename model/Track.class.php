<?php

class Track{

    private $TrackId;
    private $Name;
    private $AlbumId;
    private $MediaTypeId;
    private $GenreId;
    private $Composer;
    private $Milliseconds;
    private $Bytes;
    private $UnitPrice;

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

    public function getDurationInMinutes(){
        $minutes = floor($this->Milliseconds / 1000 / 60);
        $secondes = $this->Milliseconds / 1000 % 60;
        return $minutes . "m" . $secondes . "s";
    }

    public function getArtist(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT Artist.* FROM Artist JOIN Album ON Artist.ArtistId = Album.ArtistId WHERE Album.AlbumId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->AlbumId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Artist');
        $sth->execute();
        return $sth->fetch();
    }

    public function getImage(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT Image FROM Album WHERE AlbumId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->AlbumId, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public static function getTrack(int $id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Track WHERE TrackId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Track');
        $sth->execute();
        return $sth->fetch();
    }
}