<?php
include 'baseDeDatos.php';
    if (isset($_GET['numero'])){
        $numero = $_GET['numero'];
        eliminarPokemon($numero);
    }
?>