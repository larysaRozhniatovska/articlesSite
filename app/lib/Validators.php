<?php

namespace app\lib;

class Validators
{
      /**check login size $min ... $max
     * @param $login
     * @param $min
     * @param $max
     * @return bool
     */
    protected static function isUserLoginValid( $login, $min, $max ):bool
    {
        $len = strlen($login);
        return $len >= $min && $len <= $max;
    }

    /**
     * email verification
     * @param $email
     * @return bool
     */
    protected static function isEmailValid($email):bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * password verification
     * @param $password
     * @return array
     */
    protected static function isPasswordValid($password):array
    {
        $errors = [];

        if (!preg_match('/[\.:,;\?!@#\$%\^&\*_\-\+=]/', $password)){
            $errors[] = 'Special characters check failed';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'The password must contain at least one capital letter';
        }

        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = 'The password must contain at least one lowercase letter';
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = 'The password must contain at least one number';
        }
        return  $errors;
    }

    /**
     * checking passwords for compliance
     * @param $value
     * @param $value1
     * @return bool
     */
    protected static function isPassword2Valid($value,$value1): bool {
        return $value === $value1;
    }
    /**
     * check all info User
     * @param array $data
     * @return array
     */
    public  static function validateInfoUser(array $data): array
    {
        $errors = [];
        if ( !self::isUserLoginValid($data['login'], 4, 15)){
            $errors[] = 'Username '. $data['login'] . ' is not valid';;
        }
        if (array_key_exists('email', $data)) {
            if (!self::isEmailValid($data['email'])){
                $errors[] =  'E-mail ' . $data['email'] . ' specified incorrectly';
            }
        }
        if (array_key_exists('password', $data)) {
            $temp = self::isPasswordValid($data['password']);
            foreach ($temp as $value){
                $errors[] = $value;
            }
        }
        if (array_key_exists('repassword', $data)) {
            if (!self::isPassword2Valid($data['password'], $data['repassword'])){
                $errors[] =  "Passwords don't match, please try again";
            }
        }
        return $errors;
    }
}