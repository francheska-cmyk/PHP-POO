<?php
namespace Utils;

use PDO;

class Utils{
    public static function connect():PDO{
        return new PDO('mysql:host=127.0.0.1:3306;dbname=mvc','root','',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function passwordHash(?string $password):array{
        if(empty($password)){
            return ['message' => "Mot de passe invalide", 'code' => 'invalide'];
        }
        return ['message' => password_hash($password), 'code' => 'correct'];
    }

    public static function sanitize(string $str): string {
    return 
        htmlspecialchars(
            strip_tags(
                trim($str)
            ), ENT_COMPAT
        );
}

    public static function sanitize_array(){
        foreach ($tab as $key => $value) {
        if (gettype($value) != 'array' || $key != 'submit') {
            $tab[$key] = sanitize($value);
    }
        }
}
}