<?php

class ArtistController
{
    public function redirect($params){
        header("Location: /SAE301/artistes/a");
    }

    public function letter($params){
        extract($params);
        $artists = Artist::getArtistsByLetter($letter);
        include("view/music/artistIndexView.php");
    }

    public function albums($params){
        extract($params);
        $artist = Artist::getArtist($id);
        $albums = $artist->getAlbums();
        include("view/music/artistDetailView.php");
    }
}

