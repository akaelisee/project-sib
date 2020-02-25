<?php

    class InfosControlleur extends controlleur {

        public function __construct()
        {
            Posts::disableCSRF();
        }

        public function addInfo()
        {
            $info = [
                "title" => Posts::post('title'),
                "description" => Posts::post('description'),
                "content" => Posts::post('content'),
                "date" => date("d/m/Y à H:i")
            ];

            $this->checkInfo($info, function ($info) {
                if ($this->loadModele()->add($info)) {
                    $this->json_answer(["error" => false, "message" => "Information passée !"]);
                }
                else {
                    $this->json_answer(["error" => true, "message" => "Une erreur est survenu pendant l'ajout. Veuillez réessayer !"]);
                }
            });
        }

        public function editInfo()
        {
            $info = [
                "title" => Posts::post('title'),
                "description" => Posts::post('description'),
                "content" => Posts::post('content'),
                "id" => Posts::post('infoid')
            ];

            $this->checkInfo($info, function ($info) {
                if ($this->loadModele()->update($info)) {
                    $this->json_answer(["error" => false, "message" => "Information Modifiée !"]);
                }
                else {
                    $this->json_answer(["error" => true, "message" => "Une erreur est survenu pendant la mise à jour. Veuillez réessayer !"]);
                }
            });
        }

        public function deleteInfo()
        {
            $infoid = Posts::get('info');

            if ($this->loadModele()->deleteOne($infoid)) {
                $this->json_answer(["error" => false, "message" => "Information supprimée !"]);
            }
            else {
                $this->json_answer(["error" => true, "message" => "Une erreur est survenu pendant la mise à jour. Veuillez réessayer !"]);
            }
        }

        private function checkInfo($info, $pass)
        {
            if (strlen($info['title']) < 3) {
                $this->json_answer(["error" => true, "message" => "Titre trop court !"]);
            }
            else if (strlen($info['description']) < 7) {
                $this->json_answer(["error" => true, "message" => "Description trop courte !"]);
            }
            else if (strlen($info['content']) < 0) {
                $this->json_answer(["error" => true, "message" => "Vous êtes sensé passer une information !"]);
            }
            else {
                $pass($info);
            }
        }

    }