<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Intro</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
      </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav ml-auto mr-auto">
     <li class="nav-item active">
     <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
     </li>
     <li class="nav-item">
     <a class="nav-link" href="#">Link</a>
     </li>
     <li class="nav-item dropdown">
     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Dropdown
     </a>
     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
     <a class="dropdown-item" href="#">Action</a>
     <a class="dropdown-item" href="#">Another action</a>
     <div class="dropdown-divider"></div>
     <a class="dropdown-item" href="#">Something else here</a>
     </div>
     </li>
      <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
     </li>
     </ul>
     <form class="form-inline my-2 my-lg-0">
     <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
     <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
     </form>
     </div>
     </nav>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi eaque dolorum odit quasi a omnis, provident obcaecati tempora amet et, blanditiis magni ex doloribus eveniet laborum voluptate maiores ut sequi.
                </div>
                <div class="col-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi eaque dolorum odit quasi a omnis, provident obcaecati tempora amet et, blanditiis magni ex doloribus eveniet laborum voluptate maiores ut sequi.
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="alert alert">Contant</div>
                    <div class="alert alert-danger" role="alert">This is an Alert!</div>
                    <div class="alert alert-info" role="alert">This is an Alert!</div>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid">
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
        <h1 class="text-center mb-5 text-uppercase" style="color: #6A33D3; margin: 0; padding: 0;">Login</h1>
<div class=style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 6px 6px 10px 0px #6A33D3; max-width: 500px ; margin: auto;" >
    <form action="#" method="POST">
        <div class="form-group">
            <input class="form-control" type="email" placeholder="E-mail" name="email">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" placeholder="Password" name="pwd">
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-lg btn-block" type="submit" name="submit">Login</button>
        </div>
    </form>
</div>
        </div>
    </div>
</div>
</div>
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>