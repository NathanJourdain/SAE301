<?php

class AuthController
{
    public function login($params){
        extract($_POST);
        if(isset($email) && isset($password)){
            
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if($email == false){
                $_SESSION['erreur'] = "Email non valide";
                header("Location: /SAE301/");
                die();
            }
            
            $customer = Customer::getCustomerByEmailAndPassword($email, $password);
            if($customer){
                $_SESSION['user'] = $customer;
                header("Location: /SAE301/");
                die();
            } else {
                $employee = Employee::getEmployeeByEmailAndPassword($email, $password);
                if($employee){
                    $_SESSION['user'] = $employee;
                    header("Location: /SAE301/admin");
                    die();
                } else {
                    $_SESSION['erreur'] = "Identifiants incorrects";
                    header("Location: /SAE301/");
                    die();
                }
            }
        }
        else {
            header("Location: /SAE301/");
        }
    }

    public function logout($params){
        unset($_SESSION['user']);
        header('Location: /SAE301/');
    }
}

