<?php
include 'baseDeDatos.php';
$conn = conectarseABd();
$resultadoTipo = traerTipoPokemon();
$error = "";
if (isset($_POST['agregar'])) {
    $nro = $_POST['numero'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $imagen = 'img/pokemon/'.$_FILES['pokemon']['name'];
    $imagenFile = $_FILES['pokemon'];
    $agregarPokemon = agregarPokemon($nro, $nombre,$tipo,$imagen,$imagenFile);
    if($agregarPokemon == true){
        header("location:index.php");
        exit();
    }else{
        $error = "Error al agregar pokemon";
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
        <p class="w3-center w3-text-red" style="font-weight: bold"><?php echo $error?></p>
        <div class="w3-card">
            <form enctype="multipart/form-data" method="POST" action="agregarPokemon.php" class="w3-container">
                <div class="w3-center">
                    <h3 class="w3-center w3-text-blue" style="font-weight: bold">AGREGAR POKEMON</h3>
                </div>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <label class="w3-left-align" for="numero">Numero:</label>
                        <input class="w3-input w3-border w3-round" type="number" name="numero" min="0">
                    </div>
                    <div class="w3-col m3"><p></p></div>
                </div>
                <br><br>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <label class="w3-left-align" for="nombre">Nombre:</label>
                        <input class="w3-input w3-border w3-round" type="text" name="nombre">
                    </div>
                    <div class="w3-col m3"><p></p></div>
                </div>
                <br><br>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <label class="w3-left-align" for="tipo">Tipo:</label>
                        <select class="w3-input" name="tipo">
                            <?php
                            while ($fila = mysqli_fetch_assoc($resultadoTipo)):{
                                echo "<option value='".$fila['id']."'>".$fila['tipo']."</option>";
                            }endwhile;
                            ?>
                        </select>
                    </div>
                    <div class="w3-col m3"><p></p></div>
                </div>
                <br><br>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="625000" />
                        <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                        <label class="w3-left-align" for="pokemon">Imagen:</label>
                        <input class="w3-input" name="pokemon" type="file" />
                    </div>
                    <div class="w3-col m3"><p></p></div>
                </div>
                <br><br>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6 w3-center">
                        <button class="w3-button w3-border w3-border-green w3-green w3-round-large" type="submit" name="agregar">Agregar Pokemon</button>
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
