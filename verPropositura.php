<?php
	$cod = @$_GET["cod"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pagina de visulização</title>
</head>
<body>
<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
 <div class="fb-share-button" 
    data-href="http://facilitandosantos.github.io/verPropositura.php?cod=" 
    data-layout="button_count">
  </div>
</body>
</html>