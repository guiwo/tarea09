<?php
		/**
		*Descripción: función que conecta con la base de datos
		*@param ninguno
		*@return $conexion_mysqli , devuelve objeto bd
		*@return null si es error
		*/

function getConnection(){

    $conexion_mysqli = new mysqli('localhost','id18274056_guillermo','5oZI27x3CX@bgLOy','id18274056_autores');

		if ($conexion_mysqli->connect_error)
		{
			die("Connection failed: " . $conexion->connect_error);
		}
		else
		{
			$conexion_mysqli->set_charset("utf8");
			
			return $conexion_mysqli;
		}

}
$conex = getConnection();
if(!empty($_POST["keyword"])) {
//$query ="SELECT titulo FROM libro WHERE titulo like '" . $_POST["keyword"] . "%' ORDER BY titulo LIMIT 0,6";
$query = "SELECT libro.titulo,autor.nombre,autor.apellidos,autor.url_imagen,autor.nacionalidad FROM libro INNER JOIN autor ON libro.id_autor = autor.id where autor.nombre like '" . $_POST["keyword"] . "%'"; 
$result = $conex->query($query);
if(!empty($result)) {
?>
<ul id="lista-titulos">
<?php
foreach($result as $titulo) {
?>
<li onClick="selecionarTitulo('<?php echo $titulo["titulo"]; ?>');">
	<?php echo $titulo["nombre"]." ". $titulo["apellidos"]." - ". $titulo["titulo"]; ?>	
	
</li>

	<?php } 
		if(!empty($titulo["url_imagen"])){?>
			<div class="fotoAutor"><img class="fotoFoto" src="<?php echo $titulo["url_imagen"]?>">
			<h4><?php   echo $titulo["nombre"]." ". $titulo["apellidos"]." de ". $titulo["nacionalidad"]?></h4>
		</div>
		
			<?php
		}else{
			
			?><div class="fotoAutor"><?php echo "No existe una imagen para esa búsqueda.";?></div><?php	
		}
	} else { ?>
		<li>
	no encontrado
</li> 
<?php
	} ?>
</ul>


<?php  } ?>