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
              <li class="nav-item"><a class="nav-link active">Receitas</a></li>
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
          <img src="imgs/logo.png" alt="Website logo" class="img-fluid ">
          <h1 class="display-4 text-white">Facilitando</h1>
          <p class="lead">Aqui você entende o que vê</p>
        </div>
      </section>


      <!-- Receitas Content-->

	<div class="col-md-12 p-0 m-0">
		
			<div id="chartContainer" style="height: 300px; width: 100%;"></div>
		
	</div>
	<script src="canvas.js"></script>
	<script type="text/javascript">
		window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light1",
			title:{
				text: "Receitas da Prefeitura"
			},
			axisY: {
				title: ""
			},
			data: [{        
				type: "pie",  
				startAngle: 240,
				legendMarkerColor: "grey",
				legendText: "Alinea",
				dataPoints: [      
					<?php
                        $total_geral = 0;
						require_once("functions.php");
						$database = connect_DB();
						$buscar = "SELECT DISTINCT(ds_alinea) AS ds_alinea FROM receitas";
						$result = mysqli_query($database,$buscar);
						$i = 0;
						while($row = mysqli_fetch_assoc($result))
						{

							
							$sql = "SELECT SUM(vl_arrecadacao) AS total FROM receitas WHERE ds_alinea=\"".$row["ds_alinea"]."\"";
							$linha = mysqli_fetch_assoc(mysqli_query($database,$sql));
							$total = $linha["total"];
                            $total_geral += $total;
                            
							if($total < 12500000)
							{
								echo "{ y: ".$linha["total"].", label: \"\" },";
							}
							else
							{
								echo "{ y: ".$linha["total"].", label: \"".substr($row["ds_alinea"], 10)."\" },";
							}
						
						}

					?>
					
					{ y: 0,  label: "" }
				]
			}]
		});
		chart.render();
	}
    </script>
	<?php 
        echo "<div class='text-center m-2'><b>Total</b>: R$ ".sprintf('%0.2f', $total_geral)."</div>"; 
    ?>

      <!-- End Receitas Content-->
      

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
