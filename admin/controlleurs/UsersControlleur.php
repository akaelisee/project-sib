<?php

    class UsersControlleur extends controlleur {

        private $mdl;

        public function __construct()
        {
            Posts::disableCSRF();
            $this->mdl = $this->loadModele();
        }

        public function login()
        {
            $users = [
                "username" => Posts::post('username'),
                "password" => md5(Posts::post('password'))
            ];

            if ($user = $this->mdl->isUser($users)) {
                Session::set('userid', $user->id);
                $this->redirTo('/');
            }
            else {
                $this->redirTo('/');
            }
        }

        public function addUser()
        {
            $user = (object) [
                "nom" => Posts::post('nom'),
                "prenoms" => Posts::post('prenoms'),
                "email" => Posts::post('email'),
                "username" => Posts::post('username'),
                "password" => Posts::post('password'),
                "role" => Posts::post('role'),
                "agence" => Posts::post('agence')
            ];

            $this->checkUser($user, true, function ($user) {
                if ($this->loadModele()->add($user)) {
                    $this->json_answer(["error" => false, "message" => "Utilisateur ajouté !"]);
                }
                else {
                    $this->json_answer(["error" => true, "message" => "Une erreur est survenue !"]);
                }
            });
        }

        public function editUser()
        {
            $user_copy = $this->loadModele()->getOne(Session::get('userid'));
            $user = (object) [
                "nom" => Posts::post('nom'),
                "prenoms" => Posts::post('prenoms'),
                "email" => Posts::post('email'),
                "username" => Posts::post('username') == $user_copy->username ? $user_copy->username.'/-/-/'.uniqid() : Posts::post('username'),
                "password" => Posts::post('password'),
                "role" => $user_copy->role,
                "agence" => $user_copy->agence,
                "comptes" => $user_copy->comptes,
                "id" => Session::get('userid')
            ];

            $this->checkUser($user, strlen($user->password), function ($Euser) {
                $username = explode('/-/-/', $Euser['username']);
                $Euser['username'] = $username[0];
                $Euser['password'] = strlen($Euser['password']) ? md5($Euser['password']) : $this->loadModele()->getOne(Session::get('userid'))->password;
                if ($this->loadModele()->update($Euser)) {
                    $this->json_answer(["error" => false, "message" => "Information du compte enegistré !"]);
                }
                else  {
                    $this->json_answer(["error" => true, "message" => "Une erreur est survenue !"]);
                }
            });
        }

        function test()
        {
            echo md5("l'espritmobile");
        }

        public function deleteUser()
        {
            if ($this->loadModele()->deleteOne(Posts::get('user'))) {
                $this->json_answer(["error" => false, "message" => "Utilisateur supprimé !"]);
            }
            else {
                $this->json_answer(["error" => true, "message" => "Une erreur est survenue !"]);
            }
        }

        public function checkUser($user, $checkpass=false, $pass)
        {
            if (strlen($user->nom) < 2 || strlen($user->prenoms) < 2) {
                $this->json_answer(["error" => true, "message" => "Nom ou prénoms trop courts !"]);
            }
            else if (strlen($user->email) < 6) {
                $this->json_answer(["error" => true, "message" => "Email incorrect !"]);
            }
            else if (strlen($user->username) < 3) {
                $this->json_answer(["error" => true, "message" => "Nom d'utilisateur trop court !"]);
            }
            else if ($this->loadModele()->existUsername($user->username)) {
                $this->json_answer(["error" => true, "message" => "Nom d'utilisateur dejà utilisé !"]);
            }
            else if ($checkpass && strlen($user->password) < 6) {
                $this->json_answer(["error" => true, "message" => "Mot de passe trop court. Il doit contenir au moins 6 caractères !"]);
            }
            else if (!$this->loadModele('agences')->getOne($user->agence)) {
                $this->json_answer(["error" => true, "message" => "Veuillez bien selectionner une agence !"]);
            }
            else if ($user->role != 'root' && $user->role != 'user') {
                $this->json_answer(["error" => true, "message" => "Le role sélectionné est inconnu !"]);
            }
            else {
                $pass(json_decode(json_encode($user), true));
            }
        }

        public function getMyMeets()
        {
            $me = $this->loadModele()->getOne(Session::get('userid'));
            $mymeets = [];
            if ($me) {
                $meets = $this->loadModele('meets')->getMeets();
                foreach ($meets as $k => $meet) {
                    if (in_array($meet['account'], $me->comptes)) {
                        $mymeets[] = $meet;
                    }
                }
            }
            return $mymeets;
        }

        public function isLogged($success, $error=false)
        {
            $error = $error ? $error : function () {
                $this->redirTo('/');
            };

            if ($user = $this->mdl->getOne(Session::get('userid'))) {
                $success($user);
            }
            else {
                $error();
            }
        }

    }