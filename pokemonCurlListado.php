<?php
        $url ="https://pokeapi.co/api/v2/pokemon?limit=27/";    
        //cURL es una librería que permite comunicarse con HTTP, FTP, etc.../
        //le decimos que inicie sesión cURL con esta variable ch
		$ch = curl_init($url);                                                                  
        //con esta función se configuran las opciones de la sesión ch, 
        //enviar una url, 
        //url a enviar
        curl_setopt($ch, CURLOPT_URL, $url);   
        //con esta función pedimos que nos devuelva los datos de la función anterior                                                               
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        //almacenamos la consulta cURL (ejecución_cURL($ch)); nos devuelve un JSON
		$consulta_curl = curl_exec($ch); 
        //cerramos la sesión cURL
        curl_close($ch);
        //convertimos el JSON a un array PHP  (true == assoc)
        $consulta_PHP = json_decode($consulta_curl,true);
        /*
        var_dump($consulta_PHP);
        var_dump($consulta_PHP2);
        echo $consulta_PHP["results"][1];
        echo  $consulta_PHP["results"]["32"]['name']; //nidoking
        var_dump ($consulta_PHP2['sprites']);
        */
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Pokemon curl</title>
<style>
    @import url('css/estilo.css');
    @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap');
</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
</head>

 <body>

 <section class="contenedor">

<?php
        $j=1;

        for($i =0; $i< count($consulta_PHP['results']) ;$i++)
        {

            ?>
    
         <?php
          $url2 ="https://pokeapi.co/api/v2/pokemon/$j";
           $ch2 = curl_init($url2); 
           curl_setopt($ch2, CURLOPT_URL, $url2); 
           curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 
           $consulta_curl2 = curl_exec($ch2);
           curl_close($ch2);
           $consulta_PHP2 = json_decode($consulta_curl2,true);
            ?>
            <section class="contenedorImg">
                <img src="<?php echo $consulta_PHP2['sprites']['front_default']; ?>">
                
                <p><?php echo  $i . ". " .ucfirst($consulta_PHP["results"][$i]['name']); ?> </p>
            </section>
     
            <?php
           $j++;
          }
           ?>
        

    </section>
</body>
</html>