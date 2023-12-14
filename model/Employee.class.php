<?php

PDOConnexion::setParameters("", "", "");

class Employee{

    private $EmployeeId;
    private $LastName;
    private $FirstName;
    private $Title;
    private $ReportsTo;
    private $BirthDate;
    private $HireDate;
    private $Address;
    private $City;
    private $State;
    private $Country;
    private $PostalCode;
    private $Phone;
    private $Fax;
    private $Email;
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

    public static function getEmployeeByEmailAndPassword($email, $password){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Employee WHERE Email = :email AND Password = :password";
        $sth = $db->prepare($sql);
        $sth->bindValue(":email", $email, PDO::PARAM_STR);
        $sth->bindValue(":password", $password, PDO::PARAM_STR);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Employee');
        $sth->execute();
        return $sth->fetch();
    }

    public static function getSalesSupportAgents(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Employee WHERE Title = 'Sales Support Agent'";
        $sth = $db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Employee');
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getEmployeeById($id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Employee WHERE EmployeeId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Employee');
        $sth->execute();
        return $sth->fetch();
    }

    public static function getStatisticsOfSalesSupportAgent($id){
        $db = PDOConnexion::getInstance();
        $sql = "SELECT Customer.Country, Genre.Name as Genre, SUM(InvoiceLine.UnitPrice * InvoiceLine.Quantity) as Total, COUNT(Customer.Country) as Count FROM Invoice JOIN Customer ON Customer.CustomerId = Invoice.CustomerId JOIN InvoiceLine ON InvoiceLine.InvoiceId = Invoice.InvoiceId JOIN Track ON Track.TrackId = InvoiceLine.TrackId JOIN Genre ON Genre.GenreId = Track.GenreId WHERE Customer.SupportRepId = :id GROUP BY Customer.Country ORDER BY Customer.Country";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function getAllEmployees(int $page = 0){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Employee ORDER BY EmployeeId LIMIT 25 OFFSET :page";
        $sth = $db->prepare($sql);
        $sth->bindValue(":page", $page * 25, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Employee');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function save(){
        $db = PDOConnexion::getInstance();
        $sql = "UPDATE Employee SET FirstName = :firstname, LastName = :lastname, Address = :address, City = :city, State = :state, Country = :country, PostalCode = :postalcode, Phone = :phone, Email = :email WHERE EmployeeId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":firstname", $this->FirstName, PDO::PARAM_STR);
        $sth->bindValue(":lastname", $this->LastName, PDO::PARAM_STR);
        $sth->bindValue(":address", $this->Address, PDO::PARAM_STR);
        $sth->bindValue(":city", $this->City, PDO::PARAM_STR);
        $sth->bindValue(":state", $this->State, PDO::PARAM_STR);
        $sth->bindValue(":country", $this->Country, PDO::PARAM_STR);
        $sth->bindValue(":postalcode", $this->PostalCode, PDO::PARAM_STR);
        $sth->bindValue(":phone", $this->Phone, PDO::PARAM_STR);
        $sth->bindValue(":email", $this->Email, PDO::PARAM_STR);
        $sth->bindValue(":id", $this->EmployeeId, PDO::PARAM_INT);
        $sth->execute();
        return;
    }
}