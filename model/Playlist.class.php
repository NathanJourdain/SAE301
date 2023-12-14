<?php

PDOConnexion::setParameters("", "", "");

class Playlist{

    private $PlaylistId;
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

    public static function getAllPlaylists(int $page = 0){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Playlist ORDER BY Name LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Playlist');
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getPlaylist(int $id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Playlist WHERE PlaylistId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Playlist');
        $sth->execute();
        return $sth->fetch();
    }

    public function getTracks($page){
        $db = PDOConnexion::getInstance();
        $sql="SELECT t.* FROM PlaylistTrack as pt JOIN Track as t ON pt.TrackId = t.TrackId WHERE PlaylistId = :id LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->PlaylistId, PDO::PARAM_INT);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Track');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getNumberOfTracks(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT COUNT(*) FROM PlaylistTrack WHERE PlaylistId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->PlaylistId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public static function deletePlaylist(int $id){
        $playlist = Playlist::getPlaylist($id);
        if($playlist){
            if(file_exists("www/static/Playlists/{$playlist->Image}")){
                unlink("www/static/Playlists/{$playlist->Image}");
            }
    
            $db = PDOConnexion::getInstance();
            $sql="DELETE FROM PlaylistTrack WHERE PlaylistId = :id";
            $sth = $db->prepare($sql);
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->execute();
    
            $sql="DELETE FROM Playlist WHERE PlaylistId = :id";
            $sth = $db->prepare($sql);
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->execute();
        }
    }

    public function isTrackInPlaylist(int $trackId){
        $db = PDOConnexion::getInstance();
        $sql="SELECT COUNT(*) FROM PlaylistTrack WHERE PlaylistId = :playlistId AND TrackId = :trackId";
        $sth = $db->prepare($sql);
        $sth->bindValue(":playlistId", $this->PlaylistId, PDO::PARAM_INT);
        $sth->bindValue(":trackId", $trackId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute();
        return $sth->fetchColumn() > 0;
    }

    public function addTrack(int $trackId){
        $db = PDOConnexion::getInstance();
        $sql="INSERT INTO PlaylistTrack (PlaylistId, TrackId) VALUES (:playlistId, :trackId)";
        $sth = $db->prepare($sql);
        $sth->bindValue(":playlistId", $this->PlaylistId, PDO::PARAM_INT);
        $sth->bindValue(":trackId", $trackId, PDO::PARAM_INT);
        $sth->execute();
    }

    public function removeTrack(int $trackId){
        $db = PDOConnexion::getInstance();
        $sql="DELETE FROM PlaylistTrack WHERE PlaylistId = :playlistId AND TrackId = :trackId";
        $sth = $db->prepare($sql);
        $sth->bindValue(":playlistId", $this->PlaylistId, PDO::PARAM_INT);
        $sth->bindValue(":trackId", $trackId, PDO::PARAM_INT);
        $sth->execute();
    }

    public function save(){
        $db = PDOConnexion::getInstance();

        if($this->PlaylistId == null){
            $sql="SELECT PlaylistId FROM Playlist WHERE PlaylistId = :id";
            $sth = $db->prepare($sql);
            do{
                $this->PlaylistId = rand(0, 999999);
                $sth->bindValue(":id", $this->PlaylistId, PDO::PARAM_INT);
                $sth->execute();
            }while($sth->fetch());

            $sql="INSERT INTO Playlist (PlaylistId, Name, Image) VALUES (:id, :name, :image)";
            $sth = $db->prepare($sql);
            $sth->bindValue(":id", $this->PlaylistId, PDO::PARAM_INT);
            $sth->bindValue(":name", $this->Name, PDO::PARAM_STR);
            $sth->bindValue(":image", $this->Image, PDO::PARAM_STR);
            $sth->execute();
            $this->PlaylistId = $db->lastInsertId();
        }else{
            $sql="UPDATE Playlist SET Name = :name WHERE PlaylistId = :id";
            $sth = $db->prepare($sql);
            $sth->bindValue(":name", $this->Name, PDO::PARAM_STR);
            $sth->bindValue(":id", $this->PlaylistId, PDO::PARAM_INT);
            $sth->execute();
        }
    }
}