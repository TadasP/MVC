<?php

include_once url.'libs/Controller.php';
include_once url.'models/Users.php';
include_once url.'helpers/FormHelper.php';
include_once url.'helpers/Helper.php';

class UsersController extends Controller
{
    public function index()
    {
        $users = new Users();
        $this->view->title = 'Users';
        $users = $users->getAllUsers();
        $usersView = [];
        while($user = $users->fetch_assoc()){
            $usersView[] =  $user;
        }
        $this->view->users = $usersView;
        $this->view->headline = 'Users';
        $this->view->render('users');
    }

    public function show($var)
    {
        $users = new Users();
        $this->view->title = 'User';
        if(is_numeric($var)){
            $user = $users->getUserById($var);
        }else{
            $user = $users->getUserByName($var);
        }

        $userView = $user->fetch_assoc();
        $this->view->user = $userView;

        $postsView = [];

        if(is_numeric($var)){
            $posts = $users->getAllPostsByUserId($var);
        }else{
            $posts = $users->getAllPostsByUserName($var);
        }

        while($post = $posts->fetch_assoc()){
            $postsView[] =  $post;
        }

        $this->view->posts = $postsView;
        $this->view->render('users');
    }

    public function registration()
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/users/storeUser');

        $form->input([
            'id' => 'registrationName',
            'class' => 'form-control col-md-6',
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name'
        ],'Name');

        $form->input([
            'id' => 'registrationEmail',
            'class' => 'form-control col-md-6',
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ],'Email');

        $form->input([
            'id' => 'registrationPassword',
            'class' => 'form-control col-md-6',
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password'
        ],'Password');

        $form->input([
            'id' => 'registrationRPassord',
            'class' => 'form-control col-md-6',
            'name' => 'rpassword',
            'type' => 'password',
            'placeholder' => 'Repeat password'
        ],'Password again');

        $form->input([
            'id' => 'registrate',
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

                    if($password === $rpassword){
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $posts->registrate($name, $email, $passwordHash);
                    }else{
                        echo 'Slaptažodžiai nesutampa';
                        die();
                    }
                }else{
                    echo 'Norimas vardas arba emailas užimtas';
                    die();
                }
            }else{
                echo 'Užpildykite visus laukelius';
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
            $typedPassword = !empty($_POST['password']) ? $_POST['password'] : NULL;

            if(isset($email) && isset($typedPassword)){
                $emailCheck = $users->getUserByEmail($email);

                $passwordHash = password_hash($typedPassword, PASSWORD_DEFAULT);
                $password = $users->getUserPasswordByEmail($email);
                $password = $password->fetch_assoc();

                if (password_verify($typedPassword, $password['password']) && mysqli_num_rows($emailCheck) > 0){
                    $id = $users->getUserIdByEmail($email);
                    $id = $id->fetch_assoc();     
                    $_SESSION['loggedIn'] = $id['id'];
                    $email = $users->getUserById($id['id']);
                    $email = $email->fetch_assoc();
                    $_SESSION['email'] = $email['email'];            
                }else{
                    return;
                }
            }else{
                return;
            }
        }   
        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/index");    
    }

    public function logout()
    {
        unset($_SESSION['loggedIn']);
        unset($_SESSION['email']);
        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/index/index");
    }
}