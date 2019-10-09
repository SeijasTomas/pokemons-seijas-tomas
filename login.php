<?php
include 'baseDeDatos.php';
$conn = conectarseABd();
$error = "";
if (isset($_POST['enviar'])){
    if (isset($_POST['usuario']) && isset($_POST['password'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        if(loguearse($usuario,$password) == false){
            $error = "Error al iniciar sesion";
        }else{
            loguearse($usuario,$password);
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>POKEDEX</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
    <div class="w3-container w3-right-align">
        <button class="w3-button w3-border w3-border-green w3-green w3-round-large w3-margin-top" onclick="location.href='index.php'">Inicio</button>
    </div>
    <div class="w3-container w3-center">
        <img src="recursos/img/pokedex.png" class="w3-image">
    </div>
    <div class="w3-row">
        <div class="w3-col m3">
            <p></p>
        </div>
        <div class="w3-col m6">
            <p class="w3-center w3-text-red" style="font-weight: bold"><?php echo $error ?></p>
            <br>
            <div class="w3-card">
                <form method="POST" action="login.php" class="w3-container">
                    <div class="w3-center">
                        <h3 class="w3-center w3-text-blue" style="font-weight: bold">INICIAR SESION</h3>
                    </div>
                    <div class="w3-row">
                        <div class="w3-col m3"><p></p></div>
                        <div class="w3-col m6">
                            <label class="w3-left-align" for="usuario">Usuario:</label>
                            <input class="w3-input w3-border w3-round" type="text" name="usuario">
                        </div>
                        <div class="w3-col m3"><p></p></div>
                    </div>
                    <br><br>
                    <div class="w3-row">
                        <div class="w3-col m3"><p></p></div>
                        <div class="w3-col m6">
                            <label class="w3-left-align" for="password">Contraseña:</label>
                            <input class="w3-input w3-border w3-round" type="password" name="password">
                        </div>
                        <div class="w3-col m3"><p></p></div>
                    </div>
                    <br><br>
                    <div class="w3-row">
                        <div class="w3-col m3"><p></p></div>
                        <div class="w3-col m6 w3-center">
                            <button class="w3-button w3-border w3-border-green w3-green w3-round-large" type="submit" name="enviar">Iniciar Sesion</button>
                        </div>
                        <div class="w3-col m3"><p></p></div>
                    </div>
                    <br><br>
                </form>
            </div>
        </div>
        <div class="w3-col m3">
            <p></p>
        </div>
    </div>
    </body>
</html>
