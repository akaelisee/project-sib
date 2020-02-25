<?php

    class AgencesModele extends modele
    {
        public static function add(Array $agence)
        {
            $id = uniqid();
            $agences = json_decode(file_get_contents(ROOT.'bd/agences.json'), true);
            $agences[$agence['code']] = $agence;
            if (file_put_contents(ROOT.'bd/agences.json', json_encode($agences))) {
                return true;
            }
            else {
                return false;
            }
        }

        public static function update($agence)
        {
            $agences = json_decode(file_get_contents(ROOT.'bd/agences.json'), true);
            $agences[$agence['code']] = $agence;
            if (file_put_contents(ROOT.'bd/agences.json', json_encode($agences))) {
                return true;
            }
            else {
                return false;
            }
        }

        public static function getAll()
        {
            return json_decode(file_get_contents(ROOT.'bd/agences.json'), true);
        }

        public static function getOne($id)
        {
            $agence = json_decode(file_get_contents(ROOT.'bd/agences.json'), true);
            if (isset($agence[$id])) {
                return $agence[$id];
            }
            else {
                return false;
            }
        }

        public static function deleteOne($id)
        {
            $agences = json_decode(file_get_contents(ROOT.'bd/agences.json'), true);
            unset($agences[$id]);
            if (file_put_contents(ROOT.'bd/agences.json', json_encode($agences))) {
                return true;
            }
            else {
                return false;
            }
        }

        public static function getNextId()
        {
            $agences = json_decode(file_get_contents(ROOT.'bd/agences.json'), true);
            $last = "0000";
            foreach ($agences as $k => $agence) {
                $last = $agence['code'] > $last ? $agence['code'] : $last;
            }
            return "00" . ($last+1);
        }
    }