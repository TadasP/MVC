<div class="content">
        <?php if(isset($this->headline)): ?>
        <div class="jumbotron">
                <h1 class="display-3"><?= $this->headline ?></h1>
                <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>
        <?php endif; ?>
        <?php if(isset($this->posts)): ?>
        <div class="row">
                <div class="col-lg-12">
                <?php foreach($this->posts as $post): ?>
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem; margin:40px auto;">
                        <h3 style="text-align:center; width:80%;"><a href="/2lvl/Tadas/Model-view-controler/index.php/posts/show/<?= $post['id'] ?>"><?= $post['title']?></a></h3>
                        <p style="padding-left:5px"><?= $post['content']?></p>
                        </div>
                <?php endforeach ?>
                </div>
        </div>
        <?php endif; ?>
        <?php if(isset($this->post)): ?>
        <div class="row">
                <div class="col-lg-12" style="margin-top:20px;">
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem;">
                        <h3 style="text-align:center; width:80%;"><?= $this->post['title']?></h3>
                        <?php if(isset($this->post['photo'])): ?>
                                <img src="<?=$this->post['photo'] ?>" alt="post picture">
                        <?php endif; ?>
                        <p style="padding-left:5px"><?= $this->post['content']?></p>
                        <?php if(isset($_SESSION['loggedIn'])): ?>
                                <?php if($this->post['author_id'] === $_SESSION['loggedIn']): ?>
                                        <form method="POST" action="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/delete/<?= $this->post['id'] ?>" class="float-right">
                                                <input type="submit" name="delete-post" class="btn btn-danger btn-sm btn-send confirm-delete" value="Delete">
                                        </form>
                                        <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/<?= $this->post['id'] ?>"><button type="button" class="btn btn-primary btn-sm float-right mr-2">Edit</button></a>
                                <?php endif; ?>
                        <?php endif; ?>
                        </div>
                </div>             
        </div>
        <?php endif; ?>
        <?php if(isset($this->form)): ?>
        <?= $this->form ?>
        <?php endif; ?>
</div>
