<html>
    <head>
        <?php if(isset($this->title)) {?>
        <title><?php echo $this->title ?></title>
        <?php }else{ ?>
        <title>404</title>
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="/2lvl/Tadas/Model-view-controler/views/css/error.css">
        <link rel="stylesheet" type="text/css" href="/2lvl/Tadas/Model-view-controler/views/css/content.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/2lvl/Tadas/Model-view-controler/views/css/index.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:10px;">
            <a class="navbar-brand" href="#">MVC Page</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/posts/insert">Insert Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/2lvl/Tadas/Model-view-controler/index.php/posts/add">Add</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            </nav>
