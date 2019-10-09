<?php
function conectarseABd(){
	$hostname="localhost:3307";
	$user="root";
	$password="";
	$db="pokemons-seijas-tomas";
	$conn = mysqli_connect($hostname,$user,$password,$db);
	if(!$conn){
		die("ERROR");
	}else{
	    return $conn;
	}
}
function loguearse($usuario,$password){
	$conn = conectarseABd();
	$sql = "SELECT * FROM usuario WHERE nombreUsuario = '$usuario'";
	$resultado = mysqli_query($conn, $sql);
	if (mysqli_affected_rows($conn)== 1) {
		$fila = mysqli_fetch_assoc($resultado);
		if ($fila['password'] == $password) {
			session_start();
			$_SESSION['admin'] = true;
			header("location: index.php");
			exit();
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function traerTipoPokemon(){
	$conn = conectarseABd();
	$sql= "SELECT * FROM tipopokemon";
	$resultado = mysqli_query($conn,$sql);
	return $resultado;
}
function buscarPokemonNumero($numero){
	$conn = conectarseABd();
	$sql = "SELECT * FROM pokemon WHERE numero = '$numero'";
	$resultado = mysqli_query($conn,$sql);
	$pokemon = mysqli_fetch_assoc($resultado);
	return $pokemon;
}
function buscarPokemonNombre($nombre){
	$conn = conectarseABd();
	$sql = "SELECT * FROM pokemon INNER JOIN tipopokemon ON pokemon.tipoPokemon = tipopokemon.id WHERE nombre LIKE '$nombre'";
	$pokemons = mysqli_query($conn,$sql);
	return $pokemons;
}
function todosLosPokemones(){
	$conn = conectarseABd();
	$sql = "SELECT * FROM pokemon INNER JOIN tipopokemon ON pokemon.tipoPokemon = tipopokemon.id ORDER BY numero ASC";
	$pokemons = mysqli_query($conn,$sql);
	return $pokemons;
}
function agregarPokemon($nro,$nombre,$tipo,$imagen,$imagenFile){
	$conn = conectarseABd();
	$buscarPokemon = "SELECT * FROM pokemon WHERE numero = '$nro'";
	mysqli_query($conn, $buscarPokemon);
	if (mysqli_affected_rows($conn) == 1) {
		return false;
	} else {
		$agregarPokemon = "INSERT INTO pokemon (nombre, tipoPokemon, numero,imagen) VALUES ('$nombre', '$tipo', '$nro','$imagen');";
		if (!mysqli_query($conn, $agregarPokemon)) {
			return false;
		} else {
			$dir_subida = 'recursos/img/pokemon/';
			$fichero_subido = $dir_subida . basename($imagenFile['name']);
			move_uploaded_file($imagenFile['tmp_name'], $fichero_subido);
			return true;
		}
	}
}
function eliminarPokemon($numero){
	$conn = conectarseABd();
	$resultado = mysqli_query($conn,"SELECT imagen FROM pokemon WHERE numero = '".$numero."'");
	$fila = mysqli_fetch_assoc($resultado);
	unlink($fila['imagen']);
	$eliminar = "DELETE FROM pokemon WHERE numero = $numero";
	mysqli_query($conn,$eliminar);
	header("location: index.php");
	exit();
}
function modificarPokemon($numero,$nombre,$tipo,$imagenFile){
	$conn = conectarseABd();
	if($imagenFile['size'] != 0){
		$resultadoMod = mysqli_query($conn,"SELECT imagen FROM pokemon WHERE numero = '$numero'");
		$fila = mysqli_fetch_assoc($resultadoMod);
		unlink($fila['imagen']);

		$imagenMod = 'recursos/img/pokemon/'.$imagenFile['name'];
		$dir_subida = 'recursos/img/pokemon/';
		$fichero_subido = $dir_subida.basename($_FILES['pokemon']['name']);
		move_uploaded_file($imagenFile['tmp_name'],$fichero_subido);
		$modificarPokemon = "UPDATE pokemon SET nombre = '$nombre', tipoPokemon = '$tipo', imagen = '$imagenMod' WHERE numero = '$numero';";
		mysqli_query($conn,$modificarPokemon);
		header("location:index.php");
		exit();
	}else {
		$modificarPokemon = "UPDATE pokemon SET nombre = '$nombre', tipoPokemon = '$tipo' WHERE numero = '$numero';";
		mysqli_query($conn, $modificarPokemon);
		header("location:index.php");
		exit();
	}
}
?>
