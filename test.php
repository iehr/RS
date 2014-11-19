<?php
/*
=====================================================
PROJECT NAME - RFID
----------------------------------------------------
http://URL
-----------------------------------------------------
Copyright (c) 2014 MOBIQUOS LTDA
=====================================================
THIS IS COPYRIGHTED SOFTWARE
PLEASE READ THE LICENSE AGREEMENT
=====================================================
*/
define('DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT']);
define('SCRIPT_NAME',$_SERVER['SCRIPT_NAME']);

$arr_steps = array("1","2","3");

if ( isset($_GET['s']) ) {
    $option = 0;
    switch($_GET['s']) {
        case "1":
            $option = 2;
            echo "Step 1<br><hr>";
	    echo '<form action="'.SCRIPT_NAME.'?s='.$option.'" method="POST">';
	    echo 'Host:<input value="" name="host" placeholder="Ingresa aqui el Host (IP o Nombre)">';
	    echo 'User:<input value="" name="user">';
	    echo 'Pass:<input value="" name="pass">';
		//Falta campo con nombre de la Base de datos
		echo 'DB:<input value="" name="db">';
	    echo '<input type="submit" value="Verificar">';
	    echo "</form>";
            break;
        case "2":
            $option = 3;
	    if ( isset($_POST) && array_key_exists("host",$_POST) ){
		echo "Valores a verificar conexión a la BD con: ".$_POST['host']." / ".$_POST['user']." / ".$_POST['pass']." / ".$_POST['db']."	<br>";
		//Intertar conexion a la BD.
		//IF conexion OK: Creo el archivo conf.php con las variables para conexion.
		$textoConexion = '<?php 
		
		$dbhost = "'. $_POST["host"]. '";
		
		$dbuname = "'. $_POST["user"]. '";
		
		$dbpass = "'. $_POST["pass"]. '";
		
		$dbname = "'. $_POST["db"]. '";
		
		?>';
		
		$fp = fopen("config.php","w");
		fwrite($fp,$textoConexion);
		fclose($fp);
	    }
            else {
		echo "Debe pulsar el boton 'Verificar'<br>";
	    }
            echo "Step 2<br><hr>";
            break;
        case "3":
	    $option = 0;
		include_once('config.php');
	    //Incluir archivo de conexion (include_once('config.php');
	    //Listar
            echo "Step 3 / Congrats<br><hr>";
	    echo '<a href="'.SCRIPT_NAME.'">Exit</a>';
            break;
        default:
            echo '<a href="'.SCRIPT_NAME.'?s=1">Start</a>';
            break;
    }
    if ( in_array($option,$arr_steps) )
	echo '<a href="'.SCRIPT_NAME.'?s='.$option.'">Next</a>';

}
else {
    echo '<a href="'.SCRIPT_NAME.'?s=1">Next</a>';
}
?>
