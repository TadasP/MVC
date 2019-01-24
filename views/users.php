<div class="content">

        <?php if(isset($this->headline)): ?>
        <div class="jumbotron">
                <h1 class="display-3"><?= $this->headline ?></h1>
                <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>
        <?php endif; ?>


        <?php if(isset($this->users)): ?>
        <div class="row">
                <div class="col-lg-12" style="border-radius:.3rem;">
                <ul class="list-group">
                <?php foreach($this->users as $user): ?>
                        <li class="list-group-item">
                        <a href="/2lvl/Tadas/Model-view-controler/index.php/users/show/<?= $user['id']?>" ?>
                        <?= 'User: '.$user['name'].'. Email:' ?>
                        <?= $user['email'].'.'?>
                        </a>
                        </li>
                <?php endforeach ?>
                <ul>
                </div>
        </div>
        <?php endif; ?>

        <?php if(isset($this->user)): ?>
        <div class="row">
                <div class="col-lg-8" style="margin-top:20px;">
                <h1>User Info:</h1>
                        <div class="user" style="background-color:#e5e5e5; border-radius:.3rem;">
                                <div class="info" style="padding-left:10px;">
                                        <p id="userName">Name: <?= $this->user['name']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/ ?>">Edit</a></span></p>
                                        <p id="userEmail">Email: <?= $this->user['email']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/ ?>">Edit</a></span></p>
                                        <p id="userPassword">Password: <?= $this->user['password']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/ ?>">Edit</a></span></p>
                                        <p id="userRole">Role: <?= $this->user['role']?><span class="float-right" style="padding-right:10px;"><a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/ ?>">Edit</a></span></p>
                                </div>
                        <form method="POST" action="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/delete/ ?>" class="float-right">
                                <input type="submit" name="delete-post" class="btn btn-danger btn-sm btn-send confirm-delete" value="Delete">
                        </form>
                        </div>
                </div>             
        </div>

        <?php if(isset($this->posts)): ?>
        <div class="row">
                <div class="col-lg-12">
                <h1>User Posts: </h1>
                <?php foreach($this->posts as $post): ?>
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem; margin:40px auto;">
                        <h3 style="text-align:center; width:80%;"><a href="/2lvl/Tadas/Model-view-controler/index.php/posts/show/<?= $post['id'] ?>"><?= $post['title']?></a></h3>
                        <p style="padding-left:5px"><?= $post['content']?></p>
                        </div>
                <?php endforeach ?>
                </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>

        <?php if(isset($this->registrationForm)): ?>
        <?= $this->registrationForm ?>
        <?php endif; ?>

        <?php if(isset($this->loginForm)): ?>
        <?= $this->loginForm ?>
        <?php endif; ?>

        <div id="alert" class="alert alert-danger col-md-6" role="alert" style="visibility: hidden;"></div>
</div>