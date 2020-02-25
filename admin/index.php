<?php
	
	ini_set('error_reporting', E_ALL);

	session_start() ;

	define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME'])) ;
	define('WROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])) ;
	define('INCLUDES', ROOT.'vues/includes/') ;
	// define('HTTP_REFERER', str_replace('index.php', '', $_SERVER['HTTP_REFERER'])) ;

	$_SERVER['REQUEST_URI'] = urldecode($_SERVER['REQUEST_URI']);

	/* database variable defining */
	/***********************/

	include_once ROOT.'core/modele.php' ;
	include_once ROOT.'core/controlleur.php' ;
	include_once ROOT.'core/files.php' ;
	include_once ROOT.'core/utils.php' ;
	include_once ROOT.'core/sessions.php' ;
	include_once ROOT.'core/posts.php' ;

	/* Obtention des paramètres GET */
	$get = $_GET ;
	foreach ($get as $k => $v) {
		/* on détruit la clé existante en $k dans $_GET */
		unset($_GET[$k]) ;
		/* puis on cherche(et on extrait) la clé dans $k */
		if(preg_match("#/#", $k)){
			$k = explode('/', $k) ;
			$k = $k[count($k)-1] ;
		}
		/* et on recrée la clé précédemment détruite mais avec la clé obtenue de $k
		   et on lui affect la valeur $v
		*/
		$_GET[$k] = $v ;
	}
	/* ----- */

	/* recupperation de la partie concernant la requête */
	$q = explode('?/', $_SERVER['REQUEST_URI']) ;

	/**/
	define('BASE_URI', $q[0]);


	/* $string est la requete */
	$string = @$q[1] ;
	$string = explode('/', $string) ;
	/* $c est le controlleur demandé dans la requete */
	$c = @$string[0] ;
	/* $a est l'action que doit executer le controlleur appelé */
	$a = @$string[1] ;
	
	/* $p represente l'ensemble des paramètres passés */
	// $p = (preg_match("#&|=#", @$string[1])) ? @$string[1] : @$string[2] ;

	/* on filtre si il est demandé directement une action */
	if(count($string)==2){
		if(preg_match("#&#", $string[1]) || preg_match("#=#", $string[1])){
			/* alors le controlleur demandé est defaultsControlleur */
			$c = 'defaults' ;
			/* ... et l'action demandée est celle demandée dans l'adresse */
			$a = $string[0] ;
		}
		else{
			/* alors le controlleur demandé est celui demandé dans l'adresse */
			$c = $string[0] ;
			/* ... et l'action aussi */
			$a = $string[1] ;
		}
	}
	else if(count($string)==1){
		$c = 'defaults' ;
		/* si string contient une chaine de caractere alors cette chaine est l'action
		*  sinon index est l'action par défaut
		*/
		$a = (strlen($string[0])==0) ? 'index' : $string[0] ;
	}
	
	/* après avoir obtenu l'action $a, si elle est de forme z-b on adapte */
	$a = explode('-',$a) ;
	$foundedAction = $a[0] ;
	if(count($a)>1){
		for($i=1; $i<count($a); $i++)
			$foundedAction .= ucfirst($a[$i]) ;
	}
	/* à la fin de la manipulation on remet à $a l'action trouvée */
	$a = $foundedAction ;
	/* premier caractere du nom du controlleur en maj */
	$c = ucfirst($c);

	/* verification et execution */
	/* on verifie d'abord si le controlleur demandé existe */
	if(file_exists(ROOT.'controlleurs/'.$c.'Controlleur.php')){
		/* on inclus le fichier */
		include_once ROOT.'controlleurs/'.$c.'Controlleur.php' ;
		/* on instancie le controlleur */
		$class = $c.'Controlleur' ;
		$controlleur = new $class() ;
		/* on verifie si l'action demandée est possible pour le controlleur */
		if(method_exists($controlleur, $a)){

			define('CONTROLLEUR', $c) ;
			define('ACTION', $a) ;

			$controlleur->$a() ;
		}
		else if(!$a || strlen(trim($a))==0){
			if(method_exists($controlleur, 'index')){

				// define('CONTROLLEUR', $controlleur) ;
				// define('ACTION', 'index') ;

				$controlleur->index() ;
			}
			else{
				include_once ROOT.'vues/404.php' ;
				throw new Exception("L'action ".$a." ne peut être exécutée dans le controlleur ".$c, 1);
			}
				
		}
		/* si non, on le crie avec une exception */
		else{
			include_once ROOT.'vues/404.php' ;
			throw new Exception("L'action ".$a." ne peut être exécutée dans le controlleur ".$c, 1);
		}
	}
	else if($c=='' || strlen(trim($c))==0){
		include_once ROOT.'vues/index.php' ;
	}
	/* si non, on le crie avec une excption */
	else{
		include_once ROOT.'vues/404.php' ;
		throw new Exception("Le controlleur ".$c." est introuvable.", 1);		
	}

	/* destruction s'il y en a du message alert  */
	if(isset($_SESSION['alert'])){
		unset($_SESSION['alert']);
	}
