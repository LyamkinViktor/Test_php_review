<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;

/**
 * Class LoginController
 * @package App\Controllers
 */
class LoginController extends Controller
{

    /**
     * Login action.
     */
    protected function action()
    {
        $error = null;
        if (isset($_POST['exit'])) {
            session_unset();
        }

        if (null != $this->getCurrentUser() ) {
            header('Location: /?controller=AdminController');
            exit;
        }

        if (isset($_POST['login']) && isset($_POST['pwd'])) {
            $login = trim($_POST['login']);
            $pwd = trim($_POST['pwd']);
            if (true == $this->checkPassword($login, $pwd)) {
                $_SESSION['login'] = $login;
                header('Location: /?controller=AdminController');
                exit;
            }
            $error = 'Неверная пара логин-пароль';
        }

        $this->view->display(
            __DIR__ . '/../../templates/login.php',
            [
                'error' => $error
            ]
        );
    }

    /**
     * @return mixed|null
     */
    public function getCurrentUser()
    {
        if (isset($_SESSION['login']) && true == $this->existsUser($_SESSION['login'])) {
            return $_SESSION['login'];
        }

        return null;
    }

    /**
     * @param string $login
     * @return bool
     */
    public function existsUser(string $login): bool
    {
        /** @var User $user */
        $user = $this->getUsersList()[0];
        if ($user->getName() === $login) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    protected function getUsersList(): array
    {
        return User::findAll();
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    protected function checkPassword(string $login, string $password): bool
    {
        /** @var User $user */
        $user = $this->getUsersList()[0];

        $userData = [];
        if ($user instanceof User) {
            $userData[$user->getName()] = $user->getPassword();
        }

        $hash = $userData[$login];
        if (true == $this->existsUser($login) && true == password_verify($password, $hash)) {
            return true;
        }

        return false;
    }
}
