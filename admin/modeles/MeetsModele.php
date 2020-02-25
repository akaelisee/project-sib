<?php

class MeetsModele extends modele
{
    public static function add(Array $meet)
    {
        $id = uniqid();
        $meets = json_decode(file_get_contents(ROOT.'bd/meets.json'), true);
        $meet['id'] = $id;
        $meet['date'] = date('d/m/Y à H:i');
        $meets[$id] = $meet;
        if (file_put_contents(ROOT.'bd/meets.json', json_encode($meets))) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function getAll()
    {
        return json_decode(file_get_contents(ROOT.'bd/meets.json'), true);
    }

    public function getMeets($clients=true)
    {
        $return = [];
        $meets = json_decode(file_get_contents(ROOT.'bd/meets.json'), true);
        foreach ($meets as $k => $meet) {
            if ($meet['client'] == ($clients ? '1' : '0')) {
                $return[$k] = $meet;
            }
        }
        return $return;
    }

    public static function getOne($id)
    {
        $meets = json_decode(file_get_contents(ROOT.'bd/meets.json'), true);
        return $meets[$id];
    }

    public static function deleteOne($id)
    {
        $meets = json_decode(file_get_contents(ROOT.'bd/meets.json'), true);
        unset($meets[$id]);
        if (file_put_contents(ROOT.'bd/meets.json', json_encode($meets))) {
            return true;
        }
        else {
            return false;
        }
    }
}