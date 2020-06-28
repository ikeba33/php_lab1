<?php

class Users {

    const ROLE_CLIENT = 'client';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    private $users = [];
    private $current_user = null;

    public function __construct(){
        $this->users = [ // Заполнение данными массив
                [
                    'login' => 'user1',
                    'password' => '12345678',
                    'first_name' => 'Afanasiy',
                    'last_name' => 'Afdotiev',
                    'role' => self::ROLE_CLIENT
                ],
                [
                    'login' => 'user2',
                    'password' => '12345678',
                    'first_name' => 'Afanasiy2',
                    'last_name' => 'Afdotiev2',
                    'role' => self::ROLE_MANAGER
                ],
                [
                    'login' => 'user3',
                    'password' => '12345678',
                    'first_name' => 'Afanasiy3',
                    'last_name' => 'Afdotiev3',
                    'role' => self::ROLE_ADMIN
                ],        
            ];
    }

    // Login user by login and password
    public function loginUserByLoginAndPassword($login, $password) {
        $user = $this->getUserFromLoginAndPassword($login, $password);

        if($user != null) {
            $_SESSION['login'] = $user->getLogin();
            $_SESSION['password'] = $user->getPassword();
        }

        return $user;
    }

    // Получить пользователя по логину и паролю.
    public function getUserFromLoginAndPassword($login, $password) {

        $user = array_filter($this->users, function($value) use($login, $password) {
            return $value['login'] == $login && $value['password'] == $password;
        });

        if(empty($user)) return null;

        $user = current($user);

        // для каждой роли свой класс
        $class = $user['role'];

        // инициализация обьекта для конкретной роли
        $instanse = new $class();
        $instanse->current_user = $user;

        return $instanse;
    }

    public function getLogin() {
        return $this->current_user['login'];
    }

    public function getPassword() {
        return $this->current_user['password'];
    }

    public function getFirstName() {
        return $this->current_user['first_name'];
    }

    public function getLastName() {
        return $this->current_user['last_name'];
    }

    public function getFullName() {
        return $this->current_user['first_name'] . ' ' . $this->current_user['last_name'];
    }

    public function getRole() {
        return $this->current_user['role'];
    }

    public function isClient() {
        return $this->current_user['role'] == self::ROLE_CLIENT;
    }

    public function isManager() {
        return $this->current_user['role'] == self::ROLE_MANAGER;
    }

    public function isAdmin() {
        return $this->current_user['role'] == self::ROLE_ADMIN;
    }
}