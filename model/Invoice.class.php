<?php

class Invoice{

    private $InvoiceId;
    private $CustomerId;
    private $InvoiceDate;
    private $BillingAddress;
    private $BillingState;
    private $BillingCountry;
    private $BillingPostalCode;
    private $Total;

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

    public static function getInvoice($id){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM Invoice WHERE InvoiceId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Invoice');
        $sth->execute();
        return $sth->fetch();
    }
    
    public function getLines(){
        $db = PDOConnexion::getInstance();
        $sql="SELECT * FROM InvoiceLine WHERE InvoiceId = :id";
        $sth = $db->prepare($sql);
        $sth->bindValue(":id", $this->InvoiceId, PDO::PARAM_INT);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InvoiceLine');
        $sth->execute();
        return $sth->fetchAll();
    }


}