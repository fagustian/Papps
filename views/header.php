<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

  
    <!-- Fixed navbar -->
    <nav id="myNavbar" class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top ">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a id="siteTitle" class="navbar-brand" href="https://localhost/web/papps/"><em>Papps</em></a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item ">
            <a class="nav-link" href="#"><span class="nav-item-colour">Your timeline</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><span class="nav-item-colour">Your papps</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#"><span class="nav-item-colour">Public profiles</span></a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">

          <?php if(array_key_exists('id',$_SESSION)){
            if ($_SESSION['id']){ ?>
            <a class="btn btn-outline-secondary my-2 my-sm-0" href="?logout=4236a440a662cc8253d7536e5aa17942">Logout</a>
          <?php } }else{ ?> 

            <button class="btn btn-outline-secondary my-2 my-sm-0" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">LogIn / SignUp</button>

          <?php } ?>
           
        </form>
      </div>
    </nav>