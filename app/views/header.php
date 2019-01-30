<html>
    <head>
        <?php if(isset($this->title)) {?>
        <title><?php echo $this->title ?></title>
        <?php }else{ ?>
        <title>Untitled Page</title>
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="/2lvl/Tadas/Model-view-controler/app/views/css/error.css">
        <link rel="stylesheet" type="text/css" href="/2lvl/Tadas/Model-view-controler/app/views/css/content.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/2lvl/Tadas/Model-view-controler/app/views/css/index.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="http://localhost:8081/2lvl/Tadas/app/Model-view-controler/js/functions.js"> </script>
    </head>
    <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:10px;">
            <a class="navbar-brand" href="/2lvl/Tadas/Model-view-controler/index.php/index/index">MVC Page</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/index/index">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/users/index">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/posts/index">Posts</a>
                </li>
                <?php if(isset($_SESSION['loggedIn'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/posts/add">Add Post</a>
                </li>
                <?php endif; ?>
                </ul>
                <ul class="navbar-nav mr-auto" style="margin:0!important;">
                
                <?php if(!isset($_SESSION['loggedIn'])): ?>
                <li class="nav-item float-right">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/users/registration">Registration</a>
                </li>
                <li class="nav-item float-right">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/users/login">Login</a>
                </li>
                <?php endif; ?>
                <?php if(isset($_SESSION['loggedIn'])): ?>
                <li class="nav-item float-right">
                <a class="nav-link"> <?= $_SESSION['email'] ?></a>
                </li>
                <li class="nav-item float-right">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/users/logout">Logout</a>
                </li>
                <?php endif; ?>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="POST" action="/2lvl/Tadas/Model-view-controler/index.php/posts/searchPost">
                    <input class="form-control mr-sm-2" type="search" name="search_needle" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_posts">Search</button>
                </form>
            </div>
            </nav>
            <div class="container">
