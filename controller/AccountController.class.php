<?php

class AccountController
{
    public function index($params){
        $user = $_SESSION['user'];
        if($user instanceof Employee){
            header("Location: /SAE301/admin");
            die();
        }

        if(isset($_POST) && !empty($_POST)){
            extract($_POST);
            if(isset($infos)){
                if(isset($password) && Customer::getCustomerByEmailAndPassword($user->Email, $password) != null){
                    if(isset($FirstName) && isset($LastName) && isset($Email) && isset($Phone)){
                        $user->FirstName = $FirstName;
                        $user->LastName = $LastName;
                        $user->Email = $Email;
                        $user->Phone = $Phone;
                        $user->save();
                        $_SESSION['user'] = $user;
                        $_SESSION['success_infos'] = "Vos informations ont bien été modifiées";
                        header("Location: /SAE301/mon-compte/");
                        die();
                    }
                    else{
                        $_SESSION['error_infos'] = "Veuillez remplir tous les champs";
                    }
                }else{
                    $_SESSION['error_infos'] = "Mot de passe incorrect";
                }
            }else if(isset($location)){
                if(isset($password) && Customer::getCustomerByEmailAndPassword($user->Email, $password) != null){
                    if(isset($Address) && isset($PostalCode) && isset($City) && isset($State) && isset($Country)){
                        $user->Address = $Address;
                        $user->PostalCode = $PostalCode;
                        $user->City = $City;
                        $user->State = $State;
                        $user->Country = $Country;
                        $user->save();
                        $_SESSION['user'] = $user;
                        $_SESSION['success_location'] = "Vos informations ont bien été modifiées";
                        header("Location: /SAE301/mon-compte/");
                        die();
                    }
                    else{
                        $_SESSION['error_location'] = "Veuillez remplir tous les champs";
                    }
                }else{
                    $_SESSION['error_location'] = "Mot de passe incorrect";
                }
            }
            
        }

        include('view/customer/customerAccountView.php');
    }

    public function musics($params){
        $user = $_SESSION['user'];
        if($user instanceof Employee){
            header("Location: /SAE301/admin");
            die();
        }

        extract($_GET);
        if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
        $tracks = $user->getTracks($page);
        include('view/customer/customerMusicsView.php');
    }

    public function invoices($params){
        $user = $_SESSION['user'];
        if($user instanceof Employee){
            header("Location: /SAE301/admin");
            die();
        }

        $invoices = $user->getInvoices();
        include('view/customer/customerInvoiceView.php');
    }

    public function invoiceDetail($params){
        extract($params);
        $user = $_SESSION['user'];
        if($user instanceof Employee){
            header("Location: /SAE301/admin");
            die();
        }

        $invoice = Invoice::getInvoice($id);

        if($invoice->CustomerId == $user->CustomerId){
            $invoice = $invoice;
            $invoiceLines = $invoice->getLines();
            $total = 0;
            foreach($invoiceLines as $line){
                $total += $line->UnitPrice;
            }
            include('view/customer/customerInvoiceDetailsView.php');
        }
        else{
            header("Location: /SAE301/mon-compte/commandes");
        }
    }

}

