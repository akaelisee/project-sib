<?php

	/**
	* Le gerant des posts
	*/
	class posts
	{
		static private $checkCSRF = 1;

		function __construct()
		{

		}

		static function getCSRF()
		{
			$token = md5(md5(date('dmYHis').uniqid()));
			self::saveToken($token);

			return '<input type="hidden" name="_token" value="'.$token.'">';
		}

		static function checkCSRF($token)
		{
			if (Session::get('csrf_token') == $token) {
				return true;
			}
			else {
				throw new Exception("Wrong token detected !", 1);
				return false;
			}
		}

		static function destroyCSRF()
		{
			Session::unset('csrf_token');
		}

		static private function saveToken($token)
		{
			Session::set('csrf_token', $token);
		}



		static function post($value)
		{
			self::csrfWare();

			if (is_string($value)) {
				return self::getRequestValue($_POST, $value);
			}
			else if (is_array($value)) {
				return self::isset($_POST, $value);
			}
		}

		static function get($value)
		{
            if (is_array($value)) {
                return self::isset($_GET, $value);
            }
			else {
				return self::getRequestValue($_GET, $value);
			}
        }

		static function file($name)
		{
			return self::getRequestValue($_FILES, $name);
		}

		static private function csrfWare()
		{
			if (self::$checkCSRF) {
				if (isset($_POST['_token']) && $_POST['_token'] == Session::get('csrf_token')) {
					self::destroyCSRF();
					self::disableCSRF();
				}
				else {
					throw new Exception("CSRF MISSING ERROR CODE 1", 1);
				}
			}
		}

		static function disableCSRF()
		{
			self::$checkCSRF = 0;
		}

		static function enableCSRF()
		{
			self::$checkCSRF = 1;
		}

		static private function getRequestValue($type, $index)
		{
			if (isset($type[$index])) {
				return $type[$index];
			}
			else {
				throw new Exception("Index undefined", 1);
			}
		}

		static private function isset($type, $indexes)
		{
			$return = true;
			for ($i=0; $i<count($indexes); $i++) {
				if (!isset($type[$indexes[$i]])) {
					$return = false;
					break;
				}
			}
			return $return;
		}
	}