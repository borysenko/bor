<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$view->getTitle()?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="/<?=$view->package->getUrl('main.js')?>"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=$view->url('home')?>">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                <?php if(\bor\Auth::identity()?->getUsername()):?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <?=\bor\Auth::identity()?->getUsername()?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$view->url('logout')?>">Logout</a>
                    </li>
                <?php else:?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$view->url('login')?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$view->url('signup')?>">Signup</a>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>

<div style="margin-top:20px;" class="container">
<?=$content?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>