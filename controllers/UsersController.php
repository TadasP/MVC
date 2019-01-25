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
                        $passwordHash = Helper::generatePassword($password);
                        $posts->registrate($name, $email, $passwordHash);
                    }else{
                        $_SESSION['error'] = 'Slaptažodžiai nesutampa';
                        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                        die();
                    }
                }else{
                    $_SESSION['error'] = 'Norimas vardas arba emailas užimtas';
                    header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/registration");
                    die();
                }
            }else{
                $_SESSION['error'] = 'Užpildykite visus laukeliu';
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
                $passwordHash = Helper::generatePassword($password);

                $validation = $users->getUserInfoByEmail($email, $passwordHash);

                if (mysqli_num_rows($validation) > 0){
                    $id = $users->getUserIdByEmail($email);
                    $id = $id->fetch_assoc();     
                    $_SESSION['loggedIn'] = $id['id'];
                    $email = $users->getUserById($id['id']);
                    $email = $email->fetch_assoc();
                    $_SESSION['email'] = $email['email'];            
                }else{
                    $_SESSION['error'] = 'Neteisingas emailas arba slaptažodis';
                    header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/login");  
                    die();  
                }
            }else{
                $_SESSION['error'] = 'Užpildykite visus laukeliu';
                header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/login");
                die();    
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

    public function deleteUser($id)
    {
        $users = new Users();
        
        if(isset($_POST['delete-user'])){
            $users->delete($id);
        }

        unset($_SESSION['loggedIn']);
        unset($_SESSION['email']);

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/index");
    }

    public function editName($id)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/users/updateName/'.$id);
        $users = new Users();
        $user = $users->getUserById($id);
        $user = $user->fetch_assoc();

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name',
            'value' => $user['name']
        ],'Name');

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'update-name',
            'type' => 'submit',
            'value' => 'Update'
        ]);

        $this->view->title = 'EditName';
        $this->view->editForm = $form->get();
        $this->view->render('users');
    }

    public function updateName($id)
    {
        $users = new Users();

        if(isset($_POST['update-name'])){
            $name = $_POST['name'];
            $users->updateName($name, $id);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/show/".$id);
    }

    public function editEmail($id)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/users/updateEmail/'.$id);
        $users = new Users();
        $user = $users->getUserById($id);
        $user = $user->fetch_assoc();

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'Email',
            'value' => $user['email']
        ],'Email');

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'update-email',
            'type' => 'submit',
            'value' => 'Update'
        ]);

        $this->view->title = 'EditEmail';
        $this->view->editForm = $form->get();
        $this->view->render('users');
    }

    public function updateEmail($id)
    {
        $users = new Users();

        if(isset($_POST['update-email'])){
            $email = $_POST['email'];
            $users->updateEmail($email, $id);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/show/".$id);
    }

    public function editPassword($id)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/users/updatePassword/'.$id);
        $users = new Users();
        $user = $users->getUserById($id);
        $user = $user->fetch_assoc();

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'New password'
        ],'New password');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'rpassword',
            'type' => 'password',
            'placeholder' => 'Repeat new password'
        ],'Repeat new password');
        

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'update-password',
            'type' => 'submit',
            'value' => 'Update'
        ]);

        $this->view->title = 'EditPassword';
        $this->view->editForm = $form->get();
        $this->view->render('users');
    }

    public function updatePassword($id)
    {
        $users = new Users();

        if(isset($_POST['update-password'])){
            $password = $_POST['password'];
            $rpassword = $_POST['rpassword'];

            if(isset($password) && isset($rpassword) && $password == $rpassword){
                $passwordHash = Helper::generatePassword($password);
                $users->updatePassword($passwordHash, $id);
            }
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/show/".$id);
    }

}