<div class="content">
        <?php if(isset($this->headline)): ?>
        <div class="jumbotron">
                <h1 class="display-3"><?php echo $this->headline ?></h1>
                <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>
        <?php endif; ?>
        <?php if(isset($this->posts)): ?>
        <div class="row">
                <div class="col-lg-12">
                <?php $posts = $this->posts; ?>
                <?php while($post = $posts->fetch_assoc()): ?>
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem;">
                        <h3 style="text-align:center; width:80%;"><a href="/2lvl/Tadas/Model-view-controler/index.php/posts/show/<?= $post['id'] ?>"><?= $post['title']?></a></h3>
                        <p style="padding-left:5px"><?= $post['content']?></p>
                        </div>
                <?php endwhile ?>
                </div>
        </div>
        <?php endif; ?>
        <?php if(isset($this->post)): ?>
        <div class="row">
                <div class="col-lg-12" style="margin-top:20px;">
                <?php $post = $this->post->fetch_assoc(); ?>
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem;">
                        <h3 style="text-align:center; width:80%;"><?= $post['title']?></h3>
                        <p style="padding-left:5px"><?= $post['content']?></p>
                        <form method="POST" action="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/delete/<?= $post['id'] ?>" class="float-right">
                                <input type="submit" name="delete-post" class="btn btn-danger btn-sm btn-send confirm-delete" value="Delete">
                        </form>
                        <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/<?= $post['id'] ?>"><button type="button" class="btn btn-warning btn-sm float-right mr-2">Edit</button></a>
                        </div>
                </div>             
        </div>
        <?php endif; ?>
        <?php if(isset($this->form)): ?>
        <?php echo $this->form ?>
        <?php endif; ?>
</div>
