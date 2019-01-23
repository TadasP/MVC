<?php

include_once url.'libs/Controller.php';
include_once url.'models/Users.php';
include_once url.'helpers/FormHelper.php';
include_once url.'helpers/Helper.php';

class UsersController extends Controller
{
    public function index()
    {
        $this->view->title = 'Users';
        $this->view->headline = 'Users headline';
        $this->view->render('users');
    }

    public function show($var)
    {
        $users = new Users();
        $this->view->title = 'User';
        if(is_numeric($var)){
            $user = $posts->getUserById($var);
        }else{
            $user = $posts->getUserByName($var);
        }

        $userView = $user->fetch_assoc();
        $this->view->user = $userView;
        $this->view->render('users');
    }

    public function registration()
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/users/storeUser');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name'
        ],'Name');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ],'Email');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password'
        ],'Password');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'rpassword',
            'type' => 'password',
            'placeholder' => 'Repeat password'
        ],'Password again');

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'registrate',
            'type' => 'submit',
            'value' => 'Registrate'
        ]);

        $this->view->title = 'Registration';
        $this->view->registrationForm = $form->get();
        $this->view->render('users');
    }

    public function storeUser()
    {
        $posts = new Users();

        if(isset($_POST['registrate'])){
            $name = !empty($_POST['name']) ? $_POST['name'] : NULL;
            $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
            $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
            $rpassword = !empty($_POST['rpassword']) ? $_POST['rpassword'] : NULL;

            if(isset($name) && isset($email) && isset($password) && isset($rpassword)){
                $nameCheck = $posts->getUserByName($name);
                $emailCheck = $posts->getUserByEmail($email);
                if (!mysqli_num_rows($nameCheck) > 0 && !mysqli_num_rows($emailCheck) > 0){

                    if($password == $rpassword){
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $posts->registrate($name, $email, $passwordHash);
                    }else{
                        $_SESSION['error_message'] = 'Slaptažodžiai nesutampa';
                        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                        die();
                    }
                }else{
                    $_SESSION['error_message'] = 'Norimas vardas arba emailas užimtas';
                    header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                    die();
                }
            }else{
                $_SESSION['error_message'] = 'Užpildykite visus laukelius';
                header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                die();
            }
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/index");
    }

    public function login()
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/users/loginUser');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ],'Name');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password'
        ],'Email');

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'login',
            'type' => 'submit',
            'value' => 'Login'
        ]);
        
        $this->view->title = 'Login';
        $this->view->loginForm = $form->get();
        $this->view->render('users');
    }

    public function loginUser()
    {
        $users = new Users();

        if(isset($_POST['login'])){
            $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
            $password = !empty($_POST['password']) ? $_POST['password'] : NULL;

            if(isset($email) && isset($password)){
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $emaiCheck = $users->getUserByEmail($email);
                $passwordCheck = $users->getUserByPassword($passwordHash);

                if (mysqli_num_rows($passwordCheck) > 0 && mysqli_num_rows($emailCheck) > 0){     
                    $_SESSION['loggedIn'] = getUserIdByEmail($email);               
                }else{
                    $_SESSION['error_message'] = 'Nesutampa emailas arba slaptažodis';
                    header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                    die();
                }
            }else{
                $_SESSION['error_message'] = 'Užpildykite visus laukelius';
                header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                die();
            }
        }   
        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/index");    
    }
}