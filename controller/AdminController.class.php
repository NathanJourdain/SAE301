<?php

class AdminController
{
    public function index($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if(isset($_POST) && !empty($_POST)){
            extract($_POST);
            if(isset($infos)){
                if(isset($password) && Employee::getEmployeeByEmailAndPassword($user->Email, $password) != null){
                    if(isset($FirstName) && isset($LastName) && isset($Email) && isset($Phone)){
                        $user->FirstName = $FirstName;
                        $user->LastName = $LastName;
                        $user->Email = $Email;
                        $user->Phone = $Phone;
                        $user->save();
                        $_SESSION['user'] = $user;
                        $_SESSION['success_infos'] = "Vos informations ont bien été modifiées";
                        header("Location: /SAE301/admin/");
                        die();
                    }
                    else{
                        $_SESSION['error_infos'] = "Veuillez remplir tous les champs";
                    }
                }else{
                    $_SESSION['error_infos'] = "Mot de passe incorrect";
                }
            }else if(isset($location)){
                if(isset($password) && Employee::getEmployeeByEmailAndPassword($user->Email, $password) != null){
                    if(isset($Address) && isset($PostalCode) && isset($City) && isset($State) && isset($Country)){
                        $user->Address = $Address;
                        $user->PostalCode = $PostalCode;
                        $user->City = $City;
                        $user->State = $State;
                        $user->Country = $Country;
                        $user->save();
                        $_SESSION['user'] = $user;
                        $_SESSION['success_location'] = "Vos informations ont bien été modifiées";
                        header("Location: /SAE301/admin/");
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

        include("view/admin/adminAccountView.php");
    }

    public function allPlaylists($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($_GET);
            if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
            $playlists = Playlist::getAllPlaylists($page);
            include('view/admin/adminAllPlaylistsView.php');
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    public function createPlaylist($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($_POST);
            if(isset($name)){
                $image = $_FILES['image'];
                $imagePath = "www/static/Playlists/{$image['name']}";
                move_uploaded_file($image['tmp_name'], $imagePath);
    
                $playlist = new Playlist();
                $playlist->Name = $name;
                $playlist->Image = $image['name'];
                $playlist->save();
    
                header('Location: /SAE301/admin/playlists');
            }else{
                include('view/admin/adminCreatePlaylistView.php');
            }
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
        
    }

    public function deletePlaylist($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($params);
            Playlist::deletePlaylist($id);
            header('Location: /SAE301/admin/playlists');
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    public function addTrackToPlaylist($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }


        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($params);
            $playlist = Playlist::getPlaylist($playlistId);
            if(!$playlist->isTrackInPlaylist($trackId)){
                $playlist->addTrack($trackId);
            }
            $track = Track::getTrack($trackId);
            header("Location: /SAE301/album/{$track->AlbumId}");
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    public function removeTrackFromPlaylist($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($params);
            $playlist = Playlist::getPlaylist($playlistId);
            $playlist->removeTrack($trackId);
            header("Location: /SAE301/playlists/$playlistId");
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    public function invoiceRankingByGenre($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'Sales Support Agent' || $user->Title == 'Sales Manager' || $user->Title == 'General Manager'){
            $invoiceRanking = Genre::getInvoiceRanking();
            include('view/admin/adminInvoiceRankingByGenreView.php');
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    public function customerByCountry($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'Sales Support Agent' || $user->Title == 'Sales Manager' || $user->Title == 'General Manager'){
            $customersByCountry = Customer::getCustomersByCountry();
            include('view/admin/adminCustomersByCountryView.php');
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
        
    }

    public function customerBySalesSupportAgent($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'Sales Support Agent' || $user->Title == 'Sales Manager' || $user->Title == 'General Manager'){
            $salesSupportAgents = Employee::getSalesSupportAgents();
            extract($_GET);
            if(isset($salesSupportAgentId)){
                $statisticsOfSaleSupportAgent = Employee::getStatisticsOfSalesSupportAgent($salesSupportAgentId);
            }
        
            include('view/admin/adminCustomersBySalesSupportAgentView.php');
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    public function customerList($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }


        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($_GET);
            if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
            $customers = Customer::getAllCustomers($page);
            include('view/admin/adminCustomerListView.php');
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }

    
    public function employeeList($params){
        $user = $_SESSION['user'];
        if($user instanceof Customer){
            header("Location: /SAE301");
            die();
        }

        if($user->Title == 'IT Staff' || $user->Title == 'IT Manager'){
            extract($_GET);
            if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
            $employees = Employee::getAllEmployees($page);
            include('view/admin/adminEmployeeListView.php');    
        }
        else{
            header("Location: /SAE301/admin");
            die();
        }
    }
}

