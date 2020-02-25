<?php

	/**
	*  Le controlleur principal ! Le boss !
	*/
	class controlleur
	{
		/**
		* Return correct view to user
		* @params String $path
		* @params Array $vars
		* @return void
        * @throws Exception view
		*/
		function render($path, $vars=false){
			if($vars!=false) extract($vars) ;
			if(preg_match("#[a-zA-Z0-9]+/[a-zA-Z0-9]+#", $path)){
				$path = explode('/', $path) ;
				$ch = $path[0] ;
				$vu = $path[1] ;
				if(file_exists(ROOT.'vues/'.$ch.'/'.$vu.'.php'))
					include_once ROOT.'vues/'.$ch.'/'.$vu.'.php' ;
				else
					throw new Exception("La vue demandée est introuvable.", 1) ;
			}
			else if(preg_match("#[a-zA-Z0-9]+#", $path)){
				if(file_exists(ROOT.'vues/'.$path.'.php'))
					include_once ROOT.'vues/'.$path.'.php' ;
				else
					throw new Exception("La vue ".$path." demandée est introuvable.", 1) ;
			}
		}

		function redirTo($path,$from='window'){
			if($from=='frame') echo'<script>window.top.window.location.href="' . BASE_URI . $path.'"</script>' ;
			else header("location: ". BASE_URI . $path) ;
		}

		function loadModele($modele=false){
			if(!$modele){
				$model = get_class($this) ;
				$model = explode('Controlleur', $model) ;
				include_once ROOT.'modeles/'.ucfirst($model[0]).'Modele.php' ;
				$model = $model[0].'Modele' ;
				return new $model() ;
			}
			else{
				include_once ROOT.'modeles/'.ucfirst($modele).'Modele.php' ;
				$model = ucfirst($modele).'Modele' ;
				return new $model() ;
			}
		}

		function loadClass($classe=false){
			if(!$classe){
				$class = get_class($this) ;
				$class = explode('Controlleur', $class) ;
				$class = ucfirst($class[0]) ;
				include_once ROOT.'classes/'.$class.'.php' ;
				return new $class() ;
			}
			else{
				include_once ROOT.'classes/'.$classe.'.php' ;
				$class = ucfirst($classe) ;
				return new $class() ;	
			}
		}

		function loadController($name){
			include_once ROOT.'controlleurs/'.ucfirst($name).'Controlleur.php';
			$controlleur = ucfirst($name).'Controlleur' ;
			return new $controlleur() ;
		}

		/*
		* envoi un message d'alert à la page
		* Mais vu qu la fonction crée une variable de session pour envoyer le
		* message d'alert, cette variable devra etre détruite après traitement
		* du message
		*/
		function alert($message,$type=false,$nom='alert'){
			if(isset($_SESSION)){
				$type = $type ? $type : 'default' ;
				$_SESSION[$nom] = array($type, $message) ;
			}
		}

		function isSession($name){
			return isset($_SESSION[$name]) ;
		}

		function session($name, $value=false){
			if ($value!=false || $value=='0') {
				$_SESSION[$name] = $value;
			}
			else {
				return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
			}
		}

		function compareDate($d1, $d2){
			$one = substr($d1, 6,4).'-'.substr($d1, 3,2).'-'.substr($d1, 0,2) ;
			$two = substr($d2, 6,4).'-'.substr($d2, 3,2).'-'.substr($d2, 0,2) ;

			$one = date_create($one) ;
			$two = date_create($tow) ;

			$diff = date_diff($one,$two) ;

			return $diff->format('%R%a') ;
		}

		function jsonize($array)
		{
			return json_encode($array);
		}

		function json_answer($array)
		{
			echo $this->jsonize($array);
		}

	}