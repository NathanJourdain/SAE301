<?php

class GenreController
{
    public function all($params){
        $genres = Genre::getAllGenres();
        include("view/music/genreIndexView.php");
    }

    public function detail($params){
        extract($params);
        extract($_GET);
        if(!isset($page) || !is_numeric($page) || intval($page) < 0) $page = 0;
        $genre = Genre::getGenre($id);
        $albums = Album::getAlbumsFromGenre($id, $page);
        include("view/music/genreDetailView.php");
    }
}

