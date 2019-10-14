 <?php
include 'baseDeDatos.php';
$conn = conectarseABd();
$resultadoTipo = traerTipoPokemon();

    if (isset($_GET['numero'])){
        $numero = $_GET['numero'];
        $pokemonBuscado = buscarPokemonNumero($numero);
    }

    if (isset($_POST['modificar'])){
        if (isset($_POST['nombreMod']) && isset($_POST['tipoMod'])){
            $nroMod = $_POST['numeroMod'];
            $nombreMod = $_POST['nombreMod'];
            $tipoMod = $_POST['tipoMod'];
            $imagenFileMod = $_FILES['pokemon'];
            modificarPokemon($nroMod,$nombreMod,$tipoMod,$imagenFileMod);
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
        <div class="w3-card">
            <form enctype="multipart/form-data" method="POST" action="modificarPokemon.php" class="w3-container">
                <div class="w3-center">
                    <h3 class="w3-center w3-text-blue" style="font-weight: bold">MODIFICAR POKEMON</h3>
                </div>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <label class="w3-left-align" for="numeroMod">Numero:</label>
                        <input class="w3-input w3-border w3-round" type="number" name="numeroMod" min="0" value="<?php echo $pokemonBuscado['numero'];?>" readonly>
                    </div>
                    <div class="w3-col m3"><p></p></div>
                </div>
                <br><br>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <label class="w3-left-align" for="nombreMod">Nombre:</label>
                        <input class="w3-input w3-border w3-round" type="text" name="nombreMod"  value="<?php echo $pokemonBuscado['nombre'];?>">
                    </div>
                    <div class="w3-col m3"><p></p></div>
                </div>
                <br><br>
                <div class="w3-row">
                    <div class="w3-col m3"><p></p></div>
                    <div class="w3-col m6">
                        <label class="w3-left-align" for="tipoMod">Tipo:</label>
                        <select class="w3-input" name="tipoMod">
                            <?php
                            while ($fila = mysqli_fetch_assoc($resultadoTipo)):{
                                if($fila['id'] == $pokemonBuscado['tipoPokemon']) {
                                    echo "<option value='" . $fila['id'] . "' selected ='selected'>" . $fila['tipo'] . "</option>";
                                }else{
                                    echo "<option value='".$fila['id']."'>".$fila['tipo']."</option>";
                                }
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
                        <button class="w3-button w3-border w3-border-green w3-green w3-round-large" type="submit" name="modificar">Modificar Pokemon</button>
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
