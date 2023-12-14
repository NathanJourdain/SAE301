<?php

/**
 * Chargement des classes automatique
 */
spl_autoload_register(function ($class) {
    if (file_exists('controller/' . $class . '.class.php')) {
        require_once('controller/' . $class . '.class.php');
    } else if (file_exists('model/' . $class . '.class.php')) {
        require_once('model/' . $class . '.class.php');
    } else {
        die("File not found $class.class.php");
    }
});

session_start();
session_regenerate_id();


/**
 * Enregistrement des routes
 * Les règles les plus restrictives doivent être en premier
 */
$routes = array(
    '/^\/SAE301\/mentions-legales(\/?)/' => array(
        'controller' => 'HomeController',
        'action' => 'legalNotice',
        'protected' => false
    ),
    '/^\/SAE301\/admin\/liste-employes(\/?)/' => array(
        'controller' => 'AdminController',
        'action' => 'employeeList',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/liste-clients(\/?)/' => array(
        'controller' => 'AdminController',
        'action' => 'customerList',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/resume-achats-clients(\/?)/' => array(
        'controller' => 'AdminController',
        'action' => 'customerBySalesSupportAgent',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/clients-par-pays(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'customerByCountry',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/classement-genres(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'invoiceRankingByGenre',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/playlists\/(?<playlistId>[0-9]+)\/remove\/(?<trackId>[0-9]+)(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'removeTrackFromPlaylist',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/playlists\/(?<playlistId>[0-9]+)\/add\/(?<trackId>[0-9]+)(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'addTrackToPlaylist',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/playlists\/(?<id>[0-9]+)\/delete(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'deletePlaylist',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/playlists\/create(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'createPlaylist',
        'protected' => true
    ),
    '/^\/SAE301\/admin\/playlists(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'allPlaylists',
        'protected' => true
    ),
    '/^\/SAE301\/admin(\/?)$/' => array(
        'controller' => 'AdminController',
        'action' => 'index',
        'protected' => true
    ),
    '/^\/SAE301\/mon-compte\/factures\/(?<id>[0-9]+)(\/?)$/' => array(
        'controller' => 'AccountController',
        'action' => 'invoiceDetail',
        'protected' => true
    ),
    '/^\/SAE301\/mon-compte\/factures(\/?)$/' => array(
        'controller' => 'AccountController',
        'action' => 'invoices',
        'protected' => true
    ),
    '/^\/SAE301\/mon-compte\/musiques(\/?)/' => array(
        'controller' => 'AccountController',
        'action' => 'musics',
        'protected' => true
    ),
    '/^\/SAE301\/mon-compte(\/?)$/' => array(
        'controller' => 'AccountController',
        'action' => 'index',
        'protected' => true
    ),
    '/^\/SAE301\/auth\/logout(\/?)$/' => array(
        'controller' => 'AuthController',
        'action' => 'logout',
        'protected' => false
    ),
    '/^\/SAE301\/auth\/login(\/?)$/' => array(
        'controller' => 'AuthController',
        'action' => 'login',
        'protected' => false
    ),
    '/^\/SAE301\/album\/(?<id>[0-9]+)(\/?)$/' => array(
        'controller' => 'AlbumController',
        'action' => 'details',
        'protected' => true
    ),
    '/^\/SAE301\/playlists\/(?<id>[0-9]+)(\/?)/' => array(
        'controller' => 'PlaylistController',
        'action' => 'details',
        'protected' => true
    ),
    '/^\/SAE301\/playlists(\/?)$/' => array(
        'controller' => 'PlaylistController',
        'action' => 'all',
        'protected' => true
    ),
    '/^\/SAE301\/artistes\/(?<id>[0-9]+)(\/?)$/' => array(
        'controller' => 'ArtistController',
        'action' => 'albums',
        'protected' => true
    ),
    '/^\/SAE301\/artistes\/(?<letter>[a-zA-Z]{1})(\/?)$/' => array(
        'controller' => 'ArtistController',
        'action' => 'letter',
        'protected' => true
    ),
    '/^\/SAE301\/artistes(\/?)$/' => array(
        'controller' => 'ArtistController',
        'action' => 'redirect',
        'protected' => true
    ),
    '/^\/SAE301\/genres\/(?<id>[0-9]+)(\/?)/' => array(
        'controller' => 'GenreController',
        'action' => 'detail',
        'protected' => true
    ),
    '/^\/SAE301\/genres(\/?)$/' => array(
        'controller' => 'GenreController',
        'action' => 'all',
        'protected' => true
    ),
    '/^\/SAE301\/$/' => array(
        'controller' => 'HomeController',
        'action' => 'index',
        'protected' => false
    ),
);


$find = false;

foreach ($routes as $url => $action) {
    $matches = preg_match($url, $_SERVER['REQUEST_URI'], $params);

    // Si une url est trouvé alors on renvoie vers le controller et la méthode associé 
    if ($matches > 0) {
        if ($action['protected'] && !isset($_SESSION['user'])) {
            header('Location: /SAE301/');
        } else {
            $controller = new $action['controller'];
            $controller->{$action['action']}($params);
        }
        $find = true;
        break;
    }
}
if ($find == false) {
    http_response_code(404);
    include("view/notFoundView.php");
}
