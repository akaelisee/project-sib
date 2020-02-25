<?php

class InfosModele extends modele
{
    public static function add(Array $info)
    {
        $id = uniqid();
        $infos = json_decode(file_get_contents(ROOT.'bd/infos.json'), true);
        $info['id'] = $id;
        $infos[$id] = $info;
        if (file_put_contents(ROOT.'bd/infos.json', json_encode($infos))) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update(Array $info)
    {
        $infos = json_decode(file_get_contents(ROOT.'bd/infos.json'), true);
        $info['date'] = $infos[$info['id']]['date'];
        $infos[$info['id']] = $info;
        if (file_put_contents(ROOT.'bd/infos.json', json_encode($infos))) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function getAll()
    {
        return json_decode(file_get_contents(ROOT.'bd/infos.json'), true);
    }

    public static function getOne($id)
    {
        $infos = json_decode(file_get_contents(ROOT.'bd/infos.json'), true);
        return isset($infos[$id]) ? $infos[$id] : false;
    }

    public static function deleteOne($id)
    {
        $infos = json_decode(file_get_contents(ROOT.'bd/infos.json'), true);
        unset($infos[$id]);
        if (file_put_contents(ROOT.'bd/infos.json', json_encode($infos))) {
            return true;
        }
        else {
            return false;
        }
    }
}