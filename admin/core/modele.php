<?php

	/**
	*  Le modele principal !
	*/
	class modele
	{
		protected static $bd ;

		public function __construct(){
			try{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION ;
				modele::$bd = new PDO('mysql:dbname=paymoney; host=localhost', 'root', 'root', $pdo_options) ;
				modele::$bd->exec("set names utf8");
			} 
			catch(Exception $e){
				die('Erreur : '.$e->getMessage()) ;
			}
		}

		public static function tryLogin($formDatas,$tableColns,$tableName){
			try {
				$select = array() ;
				$executeArray = array() ;

				for($i=0; $i<count($tableColns); $i++){
					$select[] = $tableColns[$i].'=:'.$tableColns[$i] ;
					$executeArray[$tableColns[$i]] = $formDatas[$i] ;
				}
				$select = implode(' AND ', $select) ;

				$q = modele::$bd->prepare('SELECT * FROM '.$tableName.' WHERE '.$select.' LIMIT 0,1') ;
				$q->execute($executeArray) ;
				$results = $q->fetchAll() ;

				$q->closeCursor() ;

				if($results!=NULL && count($results))
					return $results[0] ;
				else
					return false ;
			} catch (Exception $e) {
				die('Erreur tryLogin : '.$e->getMessage()) ;
			}
		}

		public static function isLogged($table,$toverify){
			try{
				$string = [] ;
				/* ordonning for query */
				foreach ($toverify as $k => $v) {
					$string[] = $k."='".$v."'" ;
				}
				$string = implode(' AND ', $string) ;
				/* query */
				$q = modele::$bd->query('SELECT * FROM '.$table.' WHERE '.$string.' LIMIT 0,1') ;
				$rows = $q->fetchAll() ;

				$q->closeCursor() ;

				if(count($rows)){
					return $rows[0];
				}
				else {
					return false;
				}
			}
			catch(Exception $e){
				die($e->getMessage()) ;
			}
		}
	}