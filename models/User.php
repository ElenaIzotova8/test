<?php

class User extends Model{
    public static $table = 'users';
    
    public static function isAdmin($login, $password){        
        $return = ['status' => true];
        $user = self::getByParams(['login' => $login, 'password' => md5($password)]);
        if (count($user) == 0) {
           $return['status'] = false;
           $return['error']  = 'Неверный логин или пароль';           
           return $return;
        }
        if ($user[0]['status'] != 'adm') {
           $return['status'] = false;
           $return['error']  = 'Отказано в доступе';
           return $return;
        }
		return $return;
    }
}
