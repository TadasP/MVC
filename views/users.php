<div class="content">
        <?php if(isset($this->headline)): ?>
        <div class="jumbotron">
                <h1 class="display-3"><?= $this->headline ?></h1>
                <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>
        <?php endif; ?>
        
        <?php if(isset($this->registrationForm)): ?>
        <?= $this->registrationForm ?>
        <?php endif; ?>

        <?php if(isset($this->loginForm)): ?>
        <?= $this->loginForm ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger col-md-6" role="alert">
        <?= $_SESSION['error_message']; ?>
        </div>
        <?php $_SESSION['error_message'] == NULL ?>
        <?php endif; ?>
        <?php if(isset($_SESSION['loggedIn'])): ?>
        <?php echo $_SESSION['loggenIn'] ?>
        <?php endif ?>
</div>