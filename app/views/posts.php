<div class="content">
        <!-- Headline for index Jumbotron  -->
        <?php if(isset($this->headline)): ?>
        <div class="jumbotron">
                <h1 class="display-3"><?= $this->headline ?></h1>
                <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>
        <?php endif; ?>

        <!-- All Posts View -->
        <?php if(isset($this->posts)): ?>
        <div class="row">
                <div class="col-lg-12">
                <?php foreach($this->posts as $post): ?>
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem; margin:40px auto;">
                        <h3 style="text-align:center;"><a href="/2lvl/Tadas/Model-view-controler/index.php/posts/show/<?= $post['id'] ?>"><?= $post['title']?></a></h3>
                        <p style="padding-left:5px"><?= $post['content']?></p>
                        </div>
                <?php endforeach ?>
                </div>
        </div>
        <?php endif; ?>

        <!-- Positive Posts Search Results -->
        <?php if(isset($this->positiveSearchResults)): ?>
        <div class="row">
                <div class="col-lg-12">
                <h3>Posts containing: <?= $this->needle ?></h3>
                <?php foreach($this->positiveSearchResults as $result): ?>
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem; margin:40px auto;">
                        <h3 style="text-align:center;"><a href="/2lvl/Tadas/Model-view-controler/index.php/posts/show/<?= $result['id'] ?>"><?= $result['title']?></a></h3>
                        <p style="padding-left:5px"><?= $result['content']?></p>
                        </div>
                <?php endforeach ?>
                </div>
        </div>       
        <?php endif; ?>

        <!-- Negative Posts Search Results -->
        <?php if(isset($this->negativeSearchResults)): ?>
                <h3>Posts containing: <?= $this->needle ?></h3>
                <p><?= $this->negativeSearchResults ?></p>
        <?php endif; ?>

        <!-- Single Post View -->
        <?php if(isset($this->post)): ?>
        <div class="row">
                <div class="col-lg-12" style="margin-top:20px;">
                        <div class="post" style="background-color:#e5e5e5; border-radius:.3rem;">
                        <h5 style="text-align:center;"><?= substr($this->post['createtime'],0,-9)?></h5>
                        <h1 style="text-align:center;"><?= $this->post['title']?><br><span style="font-size:16px;">By: <?= $this->post['name']?></span></h1>
                        <?php if(($this->post['photo']) !== NULL): ?>
                                <img style="display:block; width:400px; margin:20px auto;" src="<?=$this->post['photo'] ?>" alt="post picture">
                        <?php endif; ?>

                        <p style="padding:10px 10px"><?= $this->post['content']?></p>

                        <!-- Edit Permissions -->
                        <?php if(isset($_SESSION['loggedIn'])): ?>
                                <?php if($this->post['author_id'] === $_SESSION['loggedIn']): ?>
                                        <form method="POST" action="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/deletePost/<?= $this->post['id'] ?>" class="float-right">
                                                <input type="submit" name="delete-post" class="btn btn-danger btn-sm btn-send confirm-delete" value="Delete">
                                        </form>
                                        <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/edit/<?= $this->post['id'] ?>"><button type="button" class="btn btn-primary btn-sm float-right mr-2">Edit</button></a>
                                <?php endif; ?>
                        <?php endif; ?>
                        </div>
                </div>             
        </div>

        <!-- Comments View -->
        <?php if(isset($this->comments)): ?>
        <div class="row" style="background-color:#6c757d; border-radius:.3rem; margin-top:20px;">
                <?php $i = 0; ?>
                <?php foreach($this->comments as $comment): ?>
                        <?php if($i == 0): ?>
                        <!-- Left Comments -->
                        <div class="col-lg-6">
                                <div class="post  float-left" style="background-color:#e5e5e5; border-radius:.3rem; margin:10px auto; min-width:600px;">
                                <?php if(isset($_SESSION['email'])): ?>
                                        <?php if($_SESSION['email'] == $comment['email']): ?>
                                                <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/comments/deleteComment/<?= $comment['id'] ?>"><button type="button" class="btn btn-sm float-right mr-2">Delete</button></a>
                                                <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/comments/editComment/<?= $comment['id'] ?>"><button type="button" class="btn btn-sm float-right mr-2">Edit</button></a>
                                        <?php endif; ?>
                                <?php endif; ?>
                                <h3 class="comment-name"><?= $comment['name']?></h3>
                                <p style="padding:10px 10px"><?= $comment['content']?></p>
                                
                                <?php $i++; ?>
                                </div>
                        </div>
                        <?php else: ?>
                        <!-- Right Comments -->
                        <div class="col-lg-12">
                                <div class="post  float-right" style="background-color:#e5e5e5; border-radius:.3rem; margin:10px auto; min-width:600px; ">
                                <?php if(isset($_SESSION['email'])): ?>
                                        <?php if($_SESSION['email'] == $comment['email']): ?>
                                                <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/comments/deleteComment/<?= $comment['id'] ?>"><button type="button" class="btn btn-sm float-right mr-2">Delete</button></a>
                                                <a href="http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/comments/editComment/<?= $comment['id'] ?>"><button type="button" class="btn btn-sm float-right mr-2">Edit</button></a>
                                        <?php endif; ?>
                                <?php endif; ?>
                                <h3 class="comment-name"><?= $comment['name']?></h3>
                                <p style="padding:10px 10px"><?= $comment['content']?></p>
                                <?php $i = 0; ?>
                                </div>
                        </div>
                        <?php endif; ?>
                <?php endforeach ?>
                </div>
        </div>
        <?php endif; ?>

        <!-- Comment Adding Form -->
        <?php if(isset($_SESSION['loggedIn'])): ?>
        <div class="comment-wrap" style="margin-top:50px">
                <?= $this->commentForm ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Post Adding Form -->
        <?php if(isset($this->form)): ?>
        <?= $this->form ?>
        <?php endif; ?>
</div>
