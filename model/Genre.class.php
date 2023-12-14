<?php
PDOConnexion::setParameters("", "", "");

class Genre{

    private $GenreId;
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

    public static function getAllGenres() {
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Genre";
        $sth = $db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Genre');
        $sth->execute();
        return $sth->fetchAll();
    }
    
    public static function getGenre(int $id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Genre WHERE GenreId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Genre');
        $sth->execute();
        return $sth->fetch();
    }

    public static function getInvoiceRanking(){
        $db = PDOConnexion::getInstance();
        $sql = "SELECT Genre.*, SUM(InvoiceLine.UnitPrice * InvoiceLine.Quantity) AS Total FROM Genre JOIN Track ON Genre.GenreId = Track.GenreId JOIN InvoiceLine ON Track.TrackId = InvoiceLine.TrackId GROUP BY Genre.GenreId ORDER BY Total DESC";
        $sth = $db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute();
        return $sth->fetchAll();
    }
}