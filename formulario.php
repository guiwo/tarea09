<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Buscador de libros</title>
		<style type="text/css">
		@import url('css/estilo.css');
		@import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap');	
		</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
			/**
			*Descripción: función que comprueba mediante regex un input válido
			*@param input  
			*/
		$(document).ready(function(){

			var validar_palabra = false;
			
				//if(!$("#titulo").is(':empty')){
				//if($("#titulo").val().length > 0){
					$("#titulo").keyup(function() {	
											
							var valPalabra = $("#titulo").val();
							var patronRegex = /^[a-zA-ZñÑ ]+$/;
													
								if(!patronRegex.test(valPalabra)){
								
									validar_palabra = false;
									$("#error_titulo").addClass("mostrar");
								}
								else
								{
									validar_palabra= true;
									$("#error_titulo").removeClass("mostrar");
								
								}
					
						});
				//}
		 
		});
			/**
			*Descripción: función que conecta con la bd y devuelve los datos
			*@param data keyword
			*@return data
			*/ 
		$(document).ready(function(){
				$("#titulo").keyup(function(){
					$.ajax({
					type: "POST",
					url: "conectar.php",
					data:'keyword='+$(this).val(),
					success: function(data){
						$("#sugerencias").show();
						$("#sugerencias").html(data);
						$("#titulo").css("background","#FFF");
					}
					});
				});
			});
			/**
			*Descripción: función que carga los resultados de la consulta como lista
			*@param val
			*@return 
			*@return 
			*/
			function selecionarTitulo(val) {
			$("#titulo").val(val);
			$("#sugerencias").hide();
			}
				
</script>
</head>
	<body>
		<header class="header">		
		</header>	
		
		<section class="contenedor conFoto">
			<label>Introduzca un nombre de autor</label><hr>			
			<form id="texto" >			
				<input id="titulo" type="text" value="Introduzca un nombre de autor"/><br>			
				<div id="sugerencias" ></div>				
				<span class="error ocultar" id="error_titulo">Introduzca solo letras</span>
					<br>
			</form>		

			
		</section>	
	</body>
</html>