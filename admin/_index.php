<?php

	ini_set('error_reporting', E_ALL);

	session_start() ;

	define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME'])) ;
	define('WROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])) ;
	define('INCLUDES', ROOT.'vues/includes/') ;
	// define('HTTP_REFERER', str_replace('index.php', '', $_SERVER['HTTP_REFERER'])) ;

	/* database variable defining */
	/***********************/

	include_once ROOT.'core/road.php';
	include_once ROOT.'core/modele.php' ;
	include_once ROOT.'core/controlleur.php' ;
	include_once ROOT.'core/files.php' ;
	include_once ROOT.'core/utils.php' ;
	include_once ROOT.'core/routes.php' ;
	include_once ROOT.'core/sessions.php' ;
	include_once ROOT.'core/posts.php' ;

    $_SERVER['REQUEST_URI'] = urldecode($_SERVER['REQUEST_URI']);

    /* recupperation de la partie concernant la requête */
	$q = explode('/', $_SERVER['REQUEST_URI']);

	define('BASE_URI', '/' . $q[1]);

	/* recuperation des differentes parties: controlleur, action paramètres */
	$parts = array_slice($q, 2);

	/* variable global get */
	$g = array_slice($q, 4);
	$_GET = [];
	foreach ($g as $k => $v) {
		$_GET[$k] = $v;
		$_GET["value".($k+1)] = $v;
	}
	/* controller and action */
	$ctrl = isset($parts[0]) && strlen($parts[0]) ? ucfirst($parts[0]) : 'Defaults';
	$action = isset($parts[1]) ? $parts[1] : 'index';
	/* roading */
	$road->doAction($ctrl, $action);