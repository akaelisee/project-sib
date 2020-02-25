<?php

/**
* 
*/
class Road
{

	public function doAction($controlleur, $action)
	{
		// removing tirets(-) in action
		$action = explode('-', $action);
		for ($i=0; $i<count($action); $i++) {
			if ($i>0) {
				$action[$i] = ucfirst($action[$i]);
			}
		}
		$action = implode('', $action);
		// check for controlleur exists
		if ($this->findControlleur($controlleur)) {
			include_once ROOT.'controlleurs/'.ucfirst($controlleur).'Controlleur.php';
			$ctrl = ucfirst($controlleur).'Controlleur';
			$ctrl = new $ctrl();
			if (method_exists($ctrl, $action)) {
				$ctrl->$action();
			}
			else {
				if (method_exists($ctrl, 'index')) {
					$action = 'index';
					$ctrl->$action();
				}
				else {
					throw new Exception("Action Introuvable !", 1);
				}
				
			}
		}
		else {
			if ($this->findControlleur('defaults')) {
				include_once ROOT.'controlleurs/DefaultsControlleur.php';
				$ctrl = new DefaultsControlleur();
				$action = $controlleur;
				if (method_exists($ctrl, $action)) {
					$ctrl->$action();
				}
				else {
					throw new Exception("Controlleur Introuvable", 1);
				}
			}
			else {
				throw new Exception("Controlleur Introuvable", 1);
			}
		}
	}

	public function findControlleur($controlleur)
	{
		return file_exists(ROOT.'controlleurs/'.ucfirst($controlleur).'Controlleur.php');
	}
}

$road = new Road();