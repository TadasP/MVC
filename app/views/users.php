<div class="content">
        <!-- Headline for index Jumbotron  -->
        <?php if(isset($this->headline)): ?>
        <div class="jumbotron">
                <h1 class="display-3"><?= $this->headline ?></h1>
                <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>
        <?php endif; ?>

        <!-- All Users View -->
        <?php if(isset($this->users)): ?>
        <div class="row" style="background-color:#e5e5e5; border-radius:.3rem;">
                <?php foreach($this->users as $user): ?>
                        <div class="col-md-2">
                                <div class="thumbnail" style="margin-top:10px;">
                                        <a href="/2lvl/Tadas/Model-view-controler/index.php/users/show/<?= $user['id']?>">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/Simpleicons_Interface_user-black-close-up-shape.svg" alt="Lights" style="width:100%">
                                <div class="user-name">
                                        <p style="text-align:center;"><?= $user['name']?></p>
                                </div>
                                        </a>
                                </div>
                        </div>
                <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <!-- Single User View -->
        <?php if(isset($this->user)): ?>
        <div class="row">
                <div class="col-lg-8" style="margin-top:20px;">
                <h1>User Info:</h1>
                        <!-- Edit Permissions -->
                        <?php if(isset($_SESSION['loggedIn'])): ?>
                                <?php if($this->user['id'] === $_SESSION['loggedIn']): ?>
                                        <div class="user" style="background-color:#e5e5e5; border-radius:.3rem;">
                                                <div class="info" style="padding-left:10px;">
                                                        <p id="userName">Name: <?= $this->user['name']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/editName/<?= $this->user['id'] ?>">Edit</a></span></p>
                                                        <p id="userEmail">Email: <?= $this->user['email']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/editEmail/<?= $this->user['id'] ?>">Edit</a></span></p>
                                                        <p id="userPassword">Password: <?= $this->user['password']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/editPassword/<?= $this->user['id'] ?>">Edit</a></span></p>
                                                </div>
                                        <form method="POST" action="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/deleteUser/<?= $this->user['id'] ?>" class="float-right">
                                                <input type="submit" name="delete-user" class="btn btn-danger btn-sm btn-send confirm-delete" value="Delete">
                                        </form>
                                        </div>
                                <?php endif; ?>
                        <?php endif; ?>
                        <!-- No edit permission -->
                        <?php if(isset($_SESSION['loggedIn'])): ?>
                                <?php if($this->user['id'] !== $_SESSION['loggedIn']): ?>
                                <div class="user" style="background-color:#e5e5e5; border-radius:.3rem;">
                                        <div class="info" style="padding-left:10px;">
                                                <p id="userName">Name: <?= $this->user['name']?></p>
                                                <p id="userEmail">Email: <?= $this->user['email']?></p>
                                        </div>
                                </div>
                                <?php endif; ?>
                        <?php endif; ?>
                        <!-- No edit permission -->
                        <?php if (!isset($_SESSION['loggedIn'])): ?>
                                <div class="user" style="background-color:#e5e5e5; border-radius:.3rem;">
                                        <div class="info" style="padding-left:10px;">
                                                <p id="userName">Name: <?= $this->user['name']?></p>
                                                <p id="userEmail">Email: <?= $this->user['email']?></p>
                                        </div>
                                </div>
                        <?php endif; ?>
                </div>             
        </div>
                <!-- User's Posts -->
                <?php if(isset($this->posts)): ?>
                <div class="row">
                        <div class="col-lg-12">
                        <h1>User Posts: </h1>
                        <?php foreach($this->posts as $post): ?>
                                <div class="post" style="background-color:#e5e5e5; border-radius:.3rem; margin:40px auto;">
                                <h3 style="text-align:center;"><a href="/2lvl/Tadas/Model-view-controler/index.php/posts/show/<?= $post['id'] ?>"><?= $post['title']?></a></h3>
                                <p style="padding-left:5px"><?= $post['content']?></p>
                                </div>
                        <?php endforeach ?>
                        </div>
                </div>
                <?php endif; ?>

        <?php endif; ?>

        <!-- Registration form -->
        <?php if(isset($this->registrationForm)): ?>
        <?= $this->registrationForm ?>
        <?php endif; ?>

        <!-- Login form -->
        <?php if(isset($this->loginForm)): ?>
        <?= $this->loginForm ?>
        <?php endif; ?>

        <!-- User edit form -->
        <?php if(isset($this->editForm)): ?>
        <?= $this->editForm ?>
        <?php endif; ?>
        
        <!-- Generated login/registration errors -->
        <?php if(!isset($_SESSION['loggedIn']) && isset($_SESSION['error'])) : ?>        
                <div id="alert" class="alert alert-danger col-md-6" role="alert"><?= $_SESSION['error']?></div>
                <?php unset($_SESSION['error']) ?>
        <?php endif; ?>
</div>