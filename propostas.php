  <!DOCTYPE html>
  <html lang="pt-br">
    <head>
      <title>Facilitando</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="shortcut icon" href="imgs/icon.png"/>
      <meta property="og:url" content="https://facilitandosantos.github.io/">
      <meta property="og:title" content="Facilitando">
      <meta property="og:site_name" content="Facilitando">
      <meta property="og:description" content="Website feito para que os cidadãos de Santos-SP vejam da maneira mais fácil os dados da prefeitura e câmara municipal.">
      <!-- <meta property="og:image" content=""> -->
      <meta property="og:type" content="website">
      <meta name="theme-color" content="#3399cc">

      <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">

      <script>
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        }
      </script>
      <style>
        html{
          scroll-behavior: smooth;
        }
        .jumbotron
        {
          background-image: url(imgs/jumbotron-back-test.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          background-position: bottom center;
          padding: 7rem 0;
        }

        .mastinfo
        {
          background-color: rgba(255, 255, 255, 0.5);
          padding: 2rem;
          text-align: center;
        }
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <script src="node_modules/animejs/anime.js"></script>

    <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
          <a href="#" class="navbar-brand">Facilitando</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">

          <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="index.html" class="nav-link">Início</a></li>
              <li class="nav-item"><a href="despesas.php" class="nav-link">Despesas</a></li>
              <li class="nav-item"><a href="receitas.php" class="nav-link">Receitas</a></li>
              <!-- <li class="nav-item"><a href="#" class="nav-link">Salários</a></li> --> <!-- Futuro -->
              <li class="nav-item"><a class="nav-link active" active>Propostas</a></li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navDrop">Social</a>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Facebook</a>
                    <a href="#" class="dropdown-item">Twitter</a>
                    <a href="#" class="dropdown-item">Instagram</a>
                  </div>
                </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <section class="jumbotron jumbotron-fluid text-secondary">
        <div class="container mastinfo">
          <img src="imgs/logo.png" alt="Website logo" class="img-fluid">
          <h1 class="display-4 text-white">Facilitando</h1>
          <p class="lead">Aqui você entende o que vê</p>
        </div>
      </section>


      <!-- Propostas Content-->

	<script type="text/javascript">
		function nao_apoiar(cod_propositura)
		{
			document.getElementById('cod_propositura').value = cod_propositura;
			document.getElementById('apoiar').value = '-1';
		}
		function apoiar(cod_propositura)
		{
			document.getElementById('cod_propositura').value = cod_propositura;
			document.getElementById('apoiar').value = '1';
		}
	</script>
<div class="container ">

<?php
	$i = "";
	require_once("functions.php");
	$database = connect_DB();
	$result = mysqli_query($database,"SELECT DISTINCT(autor) AS autor FROM proposituras");
	while($row = mysqli_fetch_assoc($result))
	{
		$autor = $row["autor"];
		
		$res_linha = mysqli_query($database,"SELECT * FROM proposituras WHERE autor=\"$autor\" ORDER BY data DESC");
		$linha = mysqli_fetch_assoc($res_linha);

		echo "<div class=\"col-md-12 rounded bg-dark\">
					 <div class=\"panel-group\">
					  <div class=\"panel panel-default\">
					    <div class=\"panel-heading\">
					      <h4 class=\"panel-title\">
					        <a data-toggle=\"collapse\" href=\"#collapse$i\" class=\"text-white\">
								<div class=\"row\">
									<div class=\"col-md-3 m-2 p-2\">
										<img src=\"".$linha["img"]."\" class=\"rounded\">
									</div>
							
									<div class=\"col-md-4 ml-2 p-2\">
				        				<p>
				        					<br>
				        						$autor<br>
				        						Propostas: ".mysqli_num_rows($res_linha)."<br>
				        						
				        				</p>
				    				</div>
								</div>
					    	</a>
					      </h4>
					    </div>

					    <div id=\"collapse$i\" class=\"panel-collapse collapse\" >
					      <ul class=\"list-group\">
					        <li class=\"list-group-item\">";

		while($linha = mysqli_fetch_assoc($res_linha))
		{
			$cod = $linha["cod"];
			$numero = $linha["numero"];
			$data = $linha["data"];
			$local = $linha["local"];
			$ementa = $linha["ementa"];
			$img = $linha["img"];
			$dislikes = mysqli_fetch_assoc(mysqli_query($database,"SELECT COUNT(*) AS total FROM comentarios WHERE apoio=-1 AND cod_propositura=$cod"));

			$likes = mysqli_fetch_assoc(mysqli_query($database,"SELECT COUNT(*) AS total FROM comentarios WHERE apoio=1 AND cod_propositura=$cod"));
			echo "
          <div class=\"row\">
            
              <div class=\"col-md-1\">
                <span class=\"fa fa-file fa-3x\"></span>
              </div>
              <div class=\"col-md-11 p-1\">
                <b>$local</b>
                <br>
                $ementa
                <br><br>
                <button type=\"button\" class=\"btn btn-success\" onclick=\"javascript:apoiar($cod)\" data-toggle=\"modal\" data-target=\"#myModal\">
                  ".$likes["total"]." <span class=\"fa fa-thumbs-up\"></span>
                </button>
                <button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"javascript:nao_apoiar($cod);\">
                  ".$dislikes["total"]." <span class=\"fa fa-thumbs-down\"></span>
                </button>
                <button type=\"button\" class=\"btn btn-info\" onclick=\"window.location='visualizarComentarios.php?cod=$cod'\"> <span class=\"fa fa-icon-users\" ></span>
                </button>
                <hr class='my-4'>
              </div>
              
          </div>
        ";
		}

		echo "		
					</li>
					      </ul>
					      <div class=\"panel-footer\">Footer</div>
					    </div>
						</div>
					</div> 
				</div>";
				$i++;
	}
	$i = 0;

?>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      	<div class="container">
      		<center>
		        <form action="salvarEscolha.php" method="POST" class="form-group">
		        	<input type="hidden" name="cod_propositura" id="cod_propositura" value="">
		        	<input type="hidden" name="apoiar" id="apoiar" value="">
		        	<br>
		        	CPF<input type="text" name="cpf" placeholder="CPF.." class="form-control" required>
		        	<br>
		        	<textarea class="form-control" rows="5" placeholder="Descrição" name="mensagem"></textarea>
		        	<br>
		        	<button class="btn btn-success">Comentar</button>
		        </form>
		    </center>
    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>


</div>







      <!-- End Propostas Content-->
      

      <!-- Footer -->
      <footer class="footer bg-primary text-center">
        <div class="container-fluid mb-0 p-3">
          <p class="text-white">Desenvolvido por RKB - Hack in Santos 2017</p>
        </div>
      </footer>

        <a onclick="topFunction()" id="myBtn" title="Ir para o topo" class="btn btn-light col-1 p-0 mb-2 mr-4 fixed-bottom ml-auto border"><span class="fa fa-arrow-circle-up"></span></button>
      

      <!-- Script - back to top -->
      <script>
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 1300 || document.documentElement.scrollTop > 1300) {
                
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        
        function topFunction() {
            document.body.scrollTop = 0; 
            document.documentElement.scrollTop = 0;
        }
      </script>
      <!-- End Script back to top -->

      <script src="node_modules/jquery/dist/jquery.js"></script>
      <script src="node_modules/wowjs/dist/wow.js"></script>
      <script src="node_modules/popper.js/dist/umd/popper.js"></script>
      <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </body>
  </html>
