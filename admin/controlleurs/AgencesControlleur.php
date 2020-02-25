<?php

    class AgencesControlleur extends controlleur {

        public function __construct()
        {
            Posts::disableCSRF();
        }

        public function addAgence()
        {
            $agence = [
                "nom" => Posts::post('nom'),
                "code" => Posts::post('code'),
                "commune" => Posts::post('ville'),
                "description" => Posts::post('description')
            ];

            $this->checkAgence($agence, function ($agence) {
                if ($this->loadModele()->getOne($agence['code'])) {
                    $this->json_answer(["error" => true, "message" => "Une agence avec ce code existe dejà !"]);
                }
                else {
                    if ($this->loadModele()->add($agence)) {
                        $this->json_answer(["error" => false, "message" => "Agence enregistrée !"]);
                    }
                    else {
                        $this->json_answer(["error" => true, "message" => "Une erreur est survenue veuillez réessayer !"]);
                    }
                }
            });
        }

        public function editAgence()
        {
            $agence = [
                "nom" => Posts::post('nom'),
                "code" => Posts::post('code'),
                "commune" => Posts::post('ville'),
                "description" => Posts::post('description')
            ];

            $this->checkAgence($agence, function ($agence) {
                if ($this->loadModele()->update($agence)) {
                    $this->json_answer(["error" => false, "message" => "Agence bien modifiée !"]);
                }
                else {
                    $this->json_answer(["error" => true, "message" => "Une erreur est survenue veuillez réessayer !"]);
                }
            });
        }

        public function deleteAgence()
        {
            $agenceid = Posts::get('agence');
            if ($this->loadModele()->deleteOne($agenceid)) {
                $this->json_answer(["error" => false, "message" => "Agence supprimée !"]);
            }
            else {
                $this->json_answer(["error" => true, "message" => "Une erreur est survenue veuillez réessayer !"]);
            }
        }

        public function checkAgence($agence, $pass)
        {
            if (strlen($agence['nom']) < 3) {
                $this->json_answer(["error" => true, "message" => "Nom trop court !"]);
            }
            else if (strlen($agence['code']) < 4) {
                $this->json_answer(["error" => true, "message" => "Nom trop court !"]);
            }
            else if (strlen($agence['description']) < 7) {
                $this->json_answer(["error" => true, "message" => "Description trop courte !"]);
            }
            else if (strlen($agence['commune']) < 3) {
                $this->json_answer(["error" => true, "message" => "La commune est une information importante !"]);
            }
            else {
                $pass($agence);
            }
        }


    }