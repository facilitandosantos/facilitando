<!DOCTYPE html>
<html>
<head>
	<title>Visualizar</title>

	<link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php

		$cod = @$_GET["cod"];
		if(!empty($cod))
		{
			require_once("functions.php");
			$database = connect_DB();
			$result = mysqli_query($database,"SELECT * FROM comentarios WHERE cod_propositura=$cod");
			$result2 = mysqli_query($database,"SELECT * FROM proposituras WHERE cod=$cod");
			$nome = "";
			while($row = mysqli_fetch_assoc($result2))
			{
				$nome = $row["ementa"];
			}
		}
	?>
	 <ul class="list-group">
	 	<?php 
	 		while($row = mysqli_fetch_assoc($result))
	 		{
	 			echo "<li class=\"list-group-item\">".$row["comentario"]."</li>";	
	 		}
	 		
	 	?>
	</ul> 
	<script src="node_modules/jquery/dist/jquery.js"></script>
      <script src="node_modules/wowjs/dist/wow.js"></script>
      <script src="node_modules/popper.js/dist/umd/popper.js"></script>
      <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>