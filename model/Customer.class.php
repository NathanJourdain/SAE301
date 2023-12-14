<?php

PDOConnexion::setParameters("", "", "");

class Customer{

    private $CustomerId;
    private $FirstName;
    private $LastName;
    private $Company;
    private $Address;
    private $City;
    private $State;
    private $Country;
    private $PostalCode;
    private $Phone;
    private $Fax;
    private $Email;
    private $SupportRepId;
    private $Password;


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

    public function getFullAddress(){
        return $this->Address . " " . $this->City . " " . $this->State . " " . $this->Country . " " . $this->PostalCode;
    }

    public static function getCustomerByEmailAndPassword($email, $password){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Customer WHERE Email = :email AND Password = :password";
        $sth = $db->prepare($sql);
        $sth->bindValue(":email", $email, PDO::PARAM_STR);
        $sth->bindValue(":password", $password, PDO::PARAM_STR);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Customer');
        $sth->execute();
        return $sth->fetch();
    }

    public function getTracks($page){
        $db = PDOConnexion::getInstance();
        $sql="SELECT Track.* FROM Invoice JOIN InvoiceLine ON Invoice.InvoiceId = InvoiceLine.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.InvoiceLineId WHERE Invoice.CustomerId = :id ORDER BY Invoice.InvoiceDate DESC LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->CustomerId, PDO::PARAM_INT);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Track');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getInvoices(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Invoice WHERE CustomerId = :id ORDER BY InvoiceDate DESC";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->CustomerId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Invoice');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function hasTrack($trackId){
        $db = PDOConnexion::getInstance();
        $sql="SELECT 1 FROM Invoice JOIN InvoiceLine ON Invoice.InvoiceId = InvoiceLine.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.InvoiceLineId WHERE Invoice.CustomerId = :id AND Track.TrackId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $trackId, PDO::PARAM_STR);
        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public function getTopGenres($limit){
        $db = PDOConnexion::getInstance();
        $sql="SELECT Genre.*, COUNT(Genre.GenreId) AS Count FROM Invoice JOIN InvoiceLine ON Invoice.InvoiceId = InvoiceLine.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.InvoiceLineId JOIN Genre ON Genre.GenreId = Track.GenreId WHERE Invoice.CustomerId = :id GROUP BY Genre.Name ORDER BY Count DESC LIMIT :limit";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->CustomerId, PDO::PARAM_INT);
        $sth->bindValue(":limit", $limit, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Genre');
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getCustomersByCountry(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT Customer.Country, ROUND(AVG(Invoice.Total), 2) as Average, COUNT(Customer.CustomerId) as Count FROM Customer JOIN Invoice ON Customer.CustomerId = Invoice.CustomerId GROUP BY Customer.Country ORDER BY Count DESC";
        $sth = $db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute();
        return $sth->fetchAll(); 
    }

    public static function getAllCustomers(int $page = 0){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Customer ORDER BY CustomerId LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Customer');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function save(){
        $db = PDOConnexion::getInstance();
        $sql = "UPDATE Customer SET FirstName = :firstname, LastName = :lastname, Company = :company, Address = :address, City = :city, State = :state, Country = :country, PostalCode = :postalcode, Phone = :phone, Email = :email WHERE CustomerId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":firstname", $this->FirstName, PDO::PARAM_STR);
        $sth->bindValue(":lastname", $this->LastName, PDO::PARAM_STR);
        $sth->bindValue(":company", $this->Company, PDO::PARAM_STR);
        $sth->bindValue(":address", $this->Address, PDO::PARAM_STR);
        $sth->bindValue(":city", $this->City, PDO::PARAM_STR);
        $sth->bindValue(":state", $this->State, PDO::PARAM_STR);
        $sth->bindValue(":country", $this->Country, PDO::PARAM_STR);
        $sth->bindValue(":postalcode", $this->PostalCode, PDO::PARAM_STR);
        $sth->bindValue(":phone", $this->Phone, PDO::PARAM_STR);
        $sth->bindValue(":email", $this->Email, PDO::PARAM_STR);
        $sth->bindValue(":id", $this->CustomerId, PDO::PARAM_INT);
        $sth->execute();
        return;
    }

}