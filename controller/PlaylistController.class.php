<?php

class PlaylistController
{
    public function all($params){
        extract($params);
        extract($_GET);
        if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
        $playlists = Playlist::getAllPlaylists($page);
        include('view/music/playlistIndexView.php');
    }

    public function details($params){
        extract($params);
        extract($_GET);
        if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
        
        $user = $_SESSION['user'];
        $playlist = Playlist::getPlaylist($id);
        $tracks = $playlist->getTracks($page);
        $numberOfTracks = $playlist->getNumberOfTracks();
        
        include('view/music/playlistDetailView.php');
    }
}

