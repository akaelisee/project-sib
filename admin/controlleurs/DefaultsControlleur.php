<?php

    header("Access-Control-Allow-Origin: *");

    class DefaultsControlleur extends controlleur
    {
        private $usr;

        public function __construct()
        {
            Posts::disableCSRF();
            $this->usr = $this->loadController('users');
        }

        public function index()
        {
            $this->login();
        }

        public function login()
        {
            $this->usr->isLogged(function () {
                $this->redirTo('?/account/');
            },
            function () {
                $this->render('signin');
            });
        }

        public function agencyList()
        {
            $agenceMdl = $this->loadModele('Agences');
            $agences = $agenceMdl::getAll();
            $this->json_answer($agences);
        }

        public function agencyCheck()
        {
            $agenceMdl = $this->loadModele('Agences');
            $agency = $agenceMdl::getOne(Posts::get('agency'));
            $this->json_answer($agency);
        }

        public function infosList()
        {
            $infosMdl = $this->loadModele('Infos');
            $infos = $infosMdl::getAll();
            $this->json_answer($infos);
        }

        public function meeting()
        {
            if (Posts::post('isclient')==0) {
                if (strlen(Posts::post('nom'))<2 || strlen(Posts::post('phone'))<8 || strlen(Posts::post('problem'))<5) {
                    $this->json_answer([
                        "error" => true,
                        "message" => "Veuillez remplir correctement les champs"
                    ]);
                    exit();
                }
            }
            else if (Posts::post('isclient')==1) {
                if (strlen(Posts::post('agency'))<3 || strlen(Posts::post('account'))<10 || strlen(Posts::post('phone'))<8 || strlen(Posts::post('problem'))<5) {
                    $this->json_answer([
                        "error" => true,
                        "message" => "Veuillez remplir correctement les champs"
                    ]);
                    exit();
                }
            }

            $meetMdl = $this->loadModele('Meets');
            $meet = [
                "person" => Posts::post('nom'),
                "agency" => Posts::post('agency'),
                "account" => Posts::post('account'),
                "domain" => Posts::post('domain'),
                "phone" => Posts::post('phone'),
                "email" => Posts::post('email'),
                "problem" => Posts::post('problem'),
                "client" => Posts::post('isclient')
            ];
            if ($meetMdl::add($meet)) {
                $this->json_answer([
                    "error" => false,
                    "message" => "Votre requête à bien été prise en compte. Nous vous recontacterons tres bientôt."
                ]);
            }
            else {
                $this->json_answer([
                    "error" => true,
                    "message" => "Une erreur est survenue ! Veuillez réessayer plutard SVP."
                ]);
            }
        }

        public function message()
        {
            if (strlen(Posts::post('nom'))<2 || strlen(Posts::post('phone'))<8 || strlen(Posts::post('message'))<5) {
                $this->json_answer([
                    "error" => true,
                    "message" => "Veuillez remplir correctement les champs"
                ]);
            }
            else {
                $msgMdl = $this->loadModele('Messages');
                $message = [
                    "person" => Posts::post('nom'),
                    "domain" => Posts::post('domain'),
                    "phone" => Posts::post('phone'),
                    "email" => Posts::post('email'),
                    "message" => Posts::post('message')
                ];
                if ($msgMdl::add($message)) {
                    $this->json_answer([
                        "error" => false,
                        "message" => "Votre message à bien été envoyé ! Nous vous recontacterons si besoin."
                    ]);
                }
                else {
                    $this->json_answer([
                        "error" => true,
                        "message" => "Une erreur est survenue ! Veuillez réessayer plutard SVP."
                    ]);
                }
            }
        }
    }