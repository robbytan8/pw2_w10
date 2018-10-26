<?php

/**
 * Description of UserController
 *
 * @author Robby
 */
class UserController {
    /* @var $userDao UserDaoImpl */

    private $userDao;

    public function __construct() {
        $userDao = new UserDaoImpl();
    }

    public function index() {
        $submitPressed = filter_input(INPUT_POST, "btnSubmit");
        if (isset($submitPressed)) {
            $userDao = new UserDaoImpl();
            $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $password = filter_input(INPUT_POST, "txtPassword",
                        FILTER_SANITIZE_SPECIAL_CHARS);
                $md5Password = md5($password);
                $userLogin = new User();
                $userLogin->setEmail($email);
                $userLogin->setPassword($md5Password);
                $registeredUser = $userDao->login($userLogin);
                if (isset($registeredUser) && !empty($registeredUser->name)) {
                    $_SESSION['approved_user'] = TRUE;
                    $_SESSION['user_name'] = $registeredUser->name;
                    $_SESSION['role'] = $registeredUser->role_name;
                    header('location:index.php');
                } else {
                    $errString = 'Invalid email or password';
                }
            } else {
                $errString = 'Invalid email format';
            }
        }

        if (isset($errString)) {
            echo '<div class="err_message">';
            echo $errString;
            echo '</div>';
        }
        include_once 'view/view_login.php';
    }

    public function logout() {
        $_SESSION['approved_user'] = FALSE;
        $_SESSION['user_name'] = '';
        $_SESSION['role'] = '';
        session_unset();
        session_destroy();
        header('location:index.php');
    }

    public function home() {
        if ($_SESSION['approved_user'] && isset($_SESSION['user_name'])) {
            echo 'Welcome, ' . $_SESSION['user_name'];
        } else {
            echo 'Welcome, Guest';
        }
    }

}
