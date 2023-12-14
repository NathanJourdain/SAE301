<?php

class AlbumController
{
    public function details($params){
        extract($params);
        $user = $_SESSION['user'];
        $album = Album::getAlbum($id);
        $allPlaylists = Playlist::getAllPlaylists();
        $artist = Artist::getArtist($album->ArtistId);
        $tracks = $album->getTracks();
        include('view/music/albumDetailView.php');
    }
}

