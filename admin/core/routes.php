<?php

	/**
	* 
	*/
	class Routes
	{

		static function get($action)
		{
			return BASE_URI . '/' . str_replace('.', '/', $action);
		}

		static function getRoutes()
        {
            return [
                "home" => self::get('home'),
                "new-pay" => self::get('new'),
                "list-pay" => self::get('list'),
                "pay-ranges" => self::get('range'),
                "new-range" => self::get('ranges/manage'),
                "remove-range" => self::get('ranges/delete'),
                #"profile" => self::get('profile'),
                "do-pay" => self::get("payments/new"),
                "do-login" => self::get("users/login"),
                "logout" => self::get("users/logout"),
                "default" => self::get('home'),
                "editpay" => self::get('defaults/edit-pay/')
            ];
        }

		static function find($route)
        {
            $routes = self::getRoutes();
            return isset($routes[$route]) ? $routes[$route] : $routes['default'];
        }
	}