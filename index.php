<?php
include 'baseDeDatos.php';
session_start();
$error ="";
$conn = conectarseABd();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true){
    $admin = true;
}else{
    $admin = false;
}

if (isset($_GET['buscar'])){
    if (isset($_GET['busqueda']) && $_GET['busqueda'] != ""){
        $busqueda = $_GET['busqueda'];
        $pokemons = buscarPokemonNombre($busqueda);
        if(mysqli_num_rows($pokemons) == 0){
            $error = "Pokemon no encontrado";
            $pokemons = todosLosPokemones();
        }
    }else{
        $pokemons = todosLosPokemones();
    }
}else{
    $pokemons = todosLosPokemones();
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
         <?php
         if ($admin == false){
             echo ("<button class='w3-button w3-border w3-border-green w3-green w3-round-large w3-margin-top' onclick=".'"location.href='."'login.php'".'"'.">Iniciar Sesion</button>");
         }else if ($admin == true){
             echo ("<button class='w3-button w3-border w3-border-red w3-red w3-round-large w3-margin-top' onclick=".'"location.href='."'exit.php'".'"'.">Salir</button>");
            }
         ?>
     </div>
 	<div class="w3-container w3-center">
 	 <img src="recursos/img/pokedex.png" class="w3-image">
	</div>
 	<br>
         <form method="GET" action="index.php" class="w3-row">
             <div class="w3-col m3 w3-center">
                 <p></p>
             </div>
             <div class="w3-col m4"">
                <input class="w3-input w3-border w3-round w3-margin-left" type="text" name="busqueda">
             </div>
             <div class="w3-col m2 w3-center">
                <button class="w3-button w3-border w3-border-green w3-green w3-round-large" type="submit" name="buscar">Buscar</button>
             </div>
             <div class="w3-col m3 w3-center">
                 <p></p>
             </div>
         </form>
     <br>
 	<div class="w3-row">
        <div class="w3-col m3 w3-center">
            <p></p>
        </div>
        <div class="w3-col m6 w3-center">
            <?php
            echo "<p class='w3-margin-top w3-margin-bottom w3-text-red' style='font-weight: bold'>".$error."</p>";
            ?>
            <table class="w3-table-all w3-hoverable w3-centered w3-striped w3-border ">
                <tr class="w3-blue">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Imagen</th>
                    <?php
                    if($admin == true){
                    echo "<th></th>
                          <th></th>";
                    }
                    ?>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($pokemons)):{
                    echo ("<tr>
                    <td class='w3-center'>".$fila['numero']."</td>
                    <td class='w3-center'>".$fila['nombre']."</td>
                    <td class='w3-center'><img src='".$fila['imagenTipo']."' class='w3-image' style='max-width:100%'></td>
                    <td class='w3-center'><img src='".$fila['imagen']."' class='w3-image' style='max-width:50%'></td>
                    ");
                    if($admin == true) {
                        echo("<td class='w3-center'><a href='modificarPokemon.php?numero=" . $fila['numero'] . "'>Modificar</a></td>
                           <td class='w3-center'><a href='eliminarPokemon.php?numero=" . $fila['numero'] . "'>Eliminar</a></td>	 			
                           </tr>");
                    }
                }endwhile;
                ?>
            </table>
            <br><br>
        </div>
        <div class="w3-col m3">

        </div>
        <div class="w3-row">
            <div class="w3-col m3">
                <p></p>
            </div>
            <div class="w3-col m6 w3-center">
                <?php
                if($admin == true) {
                    echo ("<button class='w3-button w3-border w3-border-green w3-green w3-round-large' onclick=".'"location.href='."'agregarPokemon.php'".'"'.">Agregar Pokemon</button>");
                }
                ?>
            </div>
            <div class="w3-col m3"></div>
        </div>
	 </div>
    <br><br>
 </body>
 </html>