<?php

class HomeController
{
    public function index($params)
    {
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];

            if($user instanceof Customer){
                $last_tracks = $user->getTracks(0);
                $top_genres = $user->getTopGenres(4);
                include("view/customer/homeView.php");
            }
            else{
                header("Location: /SAE301/admin");
            }
        }
        else{
            include("view/indexView.php");
        }
    }

    public function legalNotice($params)
    {
        include("view/legalNoticeView.php");
    }
}

