<?php
// Cuando se usan sesiones, esto es lo primero que debe aparecer
session_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/floating-labels/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <!-- Favicons -->


        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>

        <link href="./dist/css/login.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <form class="form-signin" name="" method="POST" action="logincheck.php">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            </div>

            <?php
            // Esto solo se muestra si venimos de logincheck.php porque hubo un error
            if (isset($_SESSION['login_error']) AND $_SESSION['login_error'] != '') {
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong><?php echo $_SESSION['login_error']; ?></strong>
                </div>
                <?php
                // Eliminamos la variable
                unset($_SESSION['login_error']);
            }
            ?>

            <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder=" Su direcci&#243;n de Email" required autofocus>
                <label for="inputEmail">Su direcci&#243;n de Email</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="clave" name="clave" class="form-control" placeholder="Clave" required>
                <label for="clave">Su Clave</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
        </form>


    </body>
</html>
