<?php

    class AccountControlleur extends controlleur {

        private $usr;

        public function __construct()
        {
            $this->usr = $this->loadController('users');
        }

        public function index()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('dashboard', ["user" => $user, "title" => "Accueil"]);
            });
        }

        public function infos()
        {
            $this->usr->isLogged(function ($user) {
                $info = false;
                $infos = false;

                if (Posts::get(['info'])) {
                    $info = $this->loadModele('infos')->getOne(Posts::get('info'));
                }

                $infos = $this->loadModele('infos')->getAll();

                $this->render('informations', ["user" => $user, "title" => "Informations", "infos" => $infos, "oneinfo" => $info]);
            });
        }

        public function newInfo()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('new-info', ["user" => $user, "title" => "Nouvelle information"]);
            });
        }

        public function infoEdit()
        {
            $this->usr->isLogged(function ($user) {
                if (Posts::get(['info']) && $info = $this->loadModele('infos')->getOne(Posts::get('info'))) {
                    $this->render('new-info', ["user" => $user, "title" => "Modifier l'information", "info" => $info]);
                }
                else {
                    $this->redirTo('?/account/infos');
                }
            });
        }

        public function agency()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('agencies', ["title" => "Agences", "user" => $user, "agences" => $this->loadModele('agences')->getAll()]);
            });
        }

        public function newAgency()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('new-agency', ["title" => "Nouvelle agence", "user" => $user, "nextcode" => $this->loadModele('agences')->getNextId()]);
            });
        }

        public function agencyEdit()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('new-agency', ["title" => "Nouvelle agence", "user" => $user, "agence" => $this->loadModele('agences')->getOne(Posts::get('agency'))]);
            });
        }

        public function users()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('users', ["user" => $user, "title" => "Liste d'utilisateur", "users" => UsersModele::getAll()]);
            });
        }

        public function newUser()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('new-user', ["user" => $user, "title" => "Nouvel utilisateur", "agences" => $this->loadModele('agences')->getAll()]);
            });
        }

        public function messages()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('messages', ["user" => $user, "title" => "messages", "messages" => array_reverse($this->loadModele('messages')->getAll())]);
            });
        }

        public function meets()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('meets', [
                    "user" => $user,
                    "title" => "Demandes de RDV",
                    "clientsmeets" => $this->loadController('users')->getMyMeets(),
                    "othersmeets" => $this->loadModele('meets')->getMeets(false)
                ]);
            });
        }

        function test()
        {
            echo md5("0123456789");
        }

        public function settings()
        {
            $this->usr->isLogged(function ($user) {
                $this->render('settings', ["user" => $user, "title" => "Paramètres du compte"]);
            });
        }

        public function logout()
        {
            Session::end();
            $this->redirTo('');
        }
    }