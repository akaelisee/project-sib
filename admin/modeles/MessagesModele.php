<?php

class MessagesModele extends modele
{
    public static function add(Array $message)
    {
        $id = uniqid();
        $messages = json_decode(file_get_contents(ROOT.'bd/messages.json'), true);
        $message['date'] = date("d/m/Y à H:i");
        $message['id'] = $id;
        $messages[$id] = $message;
        if (file_put_contents(ROOT.'bd/messages.json', json_encode($messages))) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function getAll()
    {
        return json_decode(file_get_contents(ROOT.'bd/messages.json'), true);
    }

    public static function getOne($id)
    {
        $message = json_decode(file_get_contents(ROOT.'bd/messages.json'), true);
        if (isset($message[$id])) {
            $message[$id]['id'] = $id;
            return $message[$id];
        }
        else {
            return false;
        }
    }

    public static function deleteOne($id)
    {
        $messages = json_decode(file_get_contents(ROOT.'bd/messages.json'), true);
        unset($messages[$id]);
        if (file_put_contents(ROOT.'bd/messages.json', json_encode($messages))) {
            return true;
        }
        else {
            return false;
        }
    }
}