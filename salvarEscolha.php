<?php

	$cpf = @$_POST["cpf"];
	$mensagem = @$_POST["mensagem"];
	$cod_propositura = @$_POST["cod_propositura"];
	$apoiar = @$_POST["apoiar"];
	if(!empty($cpf))
	{
		require_once("functions.php");
		$database = connect_DB();
		$sql = "SELECT * FROM comentarios WHERE cpf=\"$cpf\" AND cod_propositura=\"$cod_propositura\"";
		$result = mysqli_query($database,$sql);
		if(mysqli_num_rows($result) > 0)
		{
			echo "<body onLoad=\"alert('CPF já utilizado nessa propositura');window.location='propostas.php';\">";
			exit();
		}
		else
		{
			$sql = "INSERT INTO comentarios VALUES(null,$cod_propositura,\"$cpf\",\"$mensagem\",$apoiar)";
			mysqli_query($database,$sql);
		echo "<body onLoad=\"alert('Salvo com sucesso!');window.location='propostas.php';\">";
		}
	}

?>