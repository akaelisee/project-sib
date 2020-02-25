<?php

    class MessagesControlleur extends controlleur {

        public function __construct()
        {

        }

        public function getMessage()
        {
            $id = Posts::get('msg');
            $message = $this->loadModele()->getOne($id);
            if ($message) {
                $this->json_answer($message);
            }
            else {
                $this->json_answer(["message" => false]);
            }
        }

        public function deleteMessage()
        {
            $id = Posts::get('msg');
            if ($this->loadModele()->deleteOne($id)) {
                $this->json_answer(["error" => false, "Message bien supprimé"]);
            }
            else {
                $this->json_answer(["error" => true, "Une erreur est survenue !"]);
            }
        }

    }