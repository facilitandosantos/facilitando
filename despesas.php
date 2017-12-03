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
              <li class="nav-item"><a class="nav-link active">Despesas</a></li>
              <li class="nav-item"><a href="receitas.php" class="nav-link">Receitas</a></li>
              <!-- <li class="nav-item"><a href="#" class="nav-link">Salários</a></li> --> <!-- Futuro -->
              <li class="nav-item"><a href="propostas.php" class="nav-link">Propostas</a></li>
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


    <!-- Chart 1 -->
	<script src="canvas.js"></script>
	<script type="text/javascript">
		window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light1", 
			title:{
				text: "Despesas da Prefeitura - Por grupo"
			},
			axisY: {
				title: ""
			},
			data: [{        
				type: "pie",  
				startAngle: 240,
				
				legendMarkerColor: "grey",
				legendText: "Empresas",
				dataPoints: [      
					<?php
						$total_tudo = 0;

						require_once("functions.php");
						$database = connect_DB();
						$buscar = "SELECT DISTINCT(grupo) AS grupo FROM despezas";
						$result = mysqli_query($database,$buscar);
						$i = 0;
						while($row = mysqli_fetch_assoc($result))
						{
							
								$sql = "SELECT SUM(valor) AS total FROM despezas WHERE grupo=\"".$row["grupo"]."\"";
								$linha = mysqli_fetch_assoc(mysqli_query($database,$sql));
								$grupo = substr($row["grupo"], 10);
								if($linha["total"] > 22000000)
								{
									$total_tudo = $total_tudo + $linha["total"];
									echo "{ y: ".sprintf('%0.2f', $linha["total"]).", label: \"".$grupo."\" },";
								}
								else
								{
									$total_tudo = $total_tudo + $linha["total"];
									echo "{ y: ".sprintf('%0.2f', $linha["total"]).", label: \"\" },";	
								}
				}
					?>
					
					{ y: 0,  label: "" }
				]
			}]
		});


    var chart2 = new CanvasJS.Chart("chartContainer2", {
			animationEnabled: true,
			theme: "light1",
			title:{
				text: "Despesas da Prefeitura - Por empresas"
			},
			axisY: {
				title: ""
			},
			data: [{        
				type: "pie",  
				startAngle: 240,
				
				legendMarkerColor: "grey",
				legendText: "Empresas",
				dataPoints: [      
					<?php
						$total_tudo = 0;

						require_once("functions.php");
						$database = connect_DB();
						$buscar = "SELECT DISTINCT(contratada) AS contratada FROM despezas  ";
						$result = mysqli_query($database,$buscar);
						$i = 0;
						while($row = mysqli_fetch_assoc($result))
						{
							
								$sql = "SELECT SUM(valor) AS total FROM despezas WHERE contratada=\"".$row["contratada"]."\"";
								$linha = mysqli_fetch_assoc(mysqli_query($database,$sql));
								$contratada = substr($row["contratada"], 9);
								if($linha["total"] > 16900000)
								{
						
									$total_tudo = $total_tudo + $linha["total"];
									echo "{ y: ".sprintf('%0.2f', $linha["total"]).", label: \"".$contratada."\" },";
								}
								else
								{
									$total_tudo = $total_tudo + $linha["total"];
									echo "{ y: ".sprintf('%0.2f', $linha["total"]).", label: \"\" },";	
								}
            }


					?>
					
					{ y: 0,  label: "" }
				]
			}]
		});
		
    chart.render();
    chart2.render();
	}
	</script>
  

    <!-- Filling  Chart 1 -->
	<div class="col-md-12 m-0 p-0">
		
			<div id="chartContainer" style="height: 300px; width: 100%;" class="text-center"></div>
			<div class="text-center">
				<br>
			<?php 
					echo "<b>Total:</b> R$ ".sprintf('%0.2f', $total_tudo); 
			?>
		
      </div>
      </div>
  
    <!-- End Chart 1 -->
  
    <hr class="my-4">

    <!-- Filling Chart 2 -->  

    <div class="col-md-12 m-0 p-0">
			<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
        <center>
          <br><br>
        <?php 
           echo "<b>Total</b>: R$ ".sprintf('%0.2f', $total_tudo); 
        ?>
        </center>
		  </div>
    </div>
    

        <!-- Glossário -->
    <section class="container-fluid bg-light p-4">
      <h3 class="text-primary text-center mb-4">Glossário (A-Z)</h3>

      <div class="container">
        <p><span class="text-secondary font-weight-bold">ABONO DE PERMANÊNCIA</span> - pagamento do valor equivalente ao da contribuição do servidor para a previdência social, a fim de neutralizá-la.</p>
        <p><span class="text-secondary font-weight-bold">AMORTIZAÇÃO</span> - Redução da dívida.</p>
        <p><span class="text-secondary font-weight-bold">DÉFICIT ATUARIAL</span> - Insuficiência de recursos para cobertura dos compromissos dos planos de benefícios</p>
        <p><span class="text-secondary font-weight-bold">FÉRIAS - ABONO PECUNIÁRIO</span> - "abono pecuniário é o nome que se dá para a famosa "venda de férias"</p>
        <p><span class="text-secondary font-weight-bold">JETONS A CONSELHEIROS</span> - Jeton é o pagamento que se faz a parlamentares, nos níveis municipal, estadual e federal por sessões extraordinárias.</p>
        <p><span class="text-secondary font-weight-bold">LIMINAR</span> - Ordem judicial provisória.</p>
        <p><span class="text-secondary font-weight-bold">PROVENTOS - PESSOAL CIVIL</span> - proventos são os benefícios (dividendos, bonificações, direitos de subscrição, juros sobre capital e outros.</p>
          <p><span class="text-secondary font-weight-bold">PRECATÓRIOS</span> - ordem de pagamento de débito na qual figura como devedor um dos os órgãos públicos federais.</p>
        <p><span class="text-secondary font-weight-bold">RPPS</span> - Regime Próprio de Previdência Social.</p>
        <p><span class="text-secondary font-weight-bold">RGPS</span> - Regime Geral de Previdência Social.</p>
        <p><span class="text-secondary font-weight-bold">SENTENÇAS JUDICIAIS TRANSITADAS EM JULGADO</span> - Decisão judicial a qual não cabe recurso.</p>
        <p><span class="text-secondary font-weight-bold">SUBVENÇÕES SOCIAIS</span> - transferência de recursos que independe de lei específica, a instituições públicas ou privadas (de caráter assistencial - serviços essenciais de assistência: social, médica e educacional ou cultural,), sem finalidade lucrativa, com o objetivo de cobrir despesas de custeio, afeita ao controle interno dos órgãos concedentes e externo.</p>
      </div>
    </section>
    <!-- End Glossário -->



    <!-- Chart 2 -->


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
