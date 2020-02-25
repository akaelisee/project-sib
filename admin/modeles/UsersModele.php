<?php

    class UsersModele extends modele {

        public static function add($user)
        {
            $users = json_decode(file_get_contents(ROOT.'bd/users.json'), true);
            $id = uniqid();
            $user['id'] = $id;
            $user['password'] = md5($user['password']);
            $user['comptes'] = [];
            $users[$id] = $user;

            return file_put_contents(ROOT.'bd/users.json', json_encode($users));
        }

        public function update($user)
        {
            $users = json_decode(file_get_contents(ROOT.'bd/users.json'), true);
            $users[$user['id']] = $user;

            return file_put_contents(ROOT.'bd/users.json', json_encode($users));
        }

        public static function getAll()
        {
            return json_decode(file_get_contents(ROOT.'bd/users.json'), true);
        }

        public static function getOne($id)
        {
            $user = json_decode(file_get_contents(ROOT.'bd/users.json'), true);
            if (isset($user[$id])) {
                $user[$id]['id'] = $id;
                return (object) $user[$id];
            }
            else {
                return false;
            }
        }

        public function isUser($askedUser)
        {
            $users = json_decode(file_get_contents(ROOT.'bd/users.json'), true);
            $oneUser = false;
            foreach ($users as $key => $user) {
                if ($user['password'] == $askedUser['password'] && $user['username'] == $askedUser['username']) {
                    $oneUser = $user;
                    $oneUser['id'] = $key;
                    break;
                }
            }
            return $oneUser ? (object) $oneUser : $oneUser;
        }

        public function existUsername($username)
        {
            $user = false;
            $users = json_decode(file_get_contents(ROOT.'bd/users.json'), true);

            foreach ($users as $k => $oneuser) {
                if ($oneuser['username'] == $username) {
                    $user = true;
                    break;
                }
            }
            return $user;
        }

        public static function deleteOne($id)
        {
            $users = json_decode(file_get_contents(ROOT.'bd/users.json'), true);
            unset($users[$id]);
            return file_put_contents(ROOT.'bd/users.json', json_encode($users));
        }
        
    }