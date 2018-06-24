<?php
include("php/api.php");
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( "localhost", "root", "" ) or die ("No se ha podido conectar al servidor de Base de datos");	
	$db = mysqli_select_db( $conexion, "turismo" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );	
	$consulta = "SELECT * FROM alojamientos WHERE id='1'";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    $columna = mysqli_fetch_array( $resultado);
    $country = utf8_encode($columna['country']);
    $url = "http://papi.minube.com/cities?lang=ES";
    $cities = API::GET($url);    
    $ciudades = json_decode($cities,TRUE);
    $country_id = 0; 
    for($i=1;$i<count($ciudades);$i++){
        foreach($ciudades[$i] as $clave => $valor) {
            if($valor == $country){
                $country_id = $ciudades[$i]['country_id']; 
            }            
        }        
    }

    $url_pois = "http://papi.minube.com/pois?lang=ES&country_id=".$country_id;
    $pois = API::GET($url_pois);
    $points = json_decode($pois,TRUE);
    // xecho $pois;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="Elwin" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            <a href="index.html"><img src="img/logo_.png" style=" width: 30%;"></a>
            <ul class="nav navbar-nav">                      
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">¿Quienes somos?</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="#">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
    </div>

    <div class="container">
        <div class="blog-header">
            <h1 class="blog-title">Tu destino mas sostenible</h1>
            <p class="blog-post-meta"><a href="#">Atrevete a cambiar el mundo</a></p>
        </div>
        <div class="row">
<?php	
    echo '<div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">'.$columna['name'].'</h2>
                <p class="blog-post-meta">Hosted by <a href="#">'.$columna['nameOwner'].'</a></p>
                <p>'.$columna['description'].'</p>
                <ul>';
                    if($columna['fishing'] == '1') {
                        echo '<li><img src="img/fishing.ico" style="width:20px; height:20px;"> Actividades de Pesca</li>';
                    }
                    if($columna['pets'] == '1') {
                        echo '<li><img src="img/pet.ico" style="width:20px; height:20px;"> Mascotas</li>';
                    }
                    if($columna['cookingworkshop'] == '1') {
                        echo '<li><img src="img/cooking.ico" style="width:20px; height:20px;"> Se permite cocinar</li>';
                    }
                    if($columna['equestrianRoute'] == '1') {
                        echo '<li><img src="img/equestrian.ico" style="width:20px; height:20px;"> Recorrido a caballo</li>';        
                    }                                                
                    if($columna['fishing'] == '1') {
                        echo '<li><img src="img/fishing.ico" style="width:20px; height:20px;"> Actividades de pesca</li>';
                    }
                    if($columna['seaactivities'] == '1') {
                        echo '<li><img src="img/seaactivities.ico" style="width:20px; height:20px;"> Actividades en el Mar</li>';
                    }
                echo '</ul>
                    <blockquote>
                    <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </blockquote>
                    <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            </div><!-- /.blog-post -->';        
        mysqli_close( $conexion );
?>
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar"> 
<?php
        for($i=1;$i<6;$i++){
            echo '<div class="sidebar-module sidebar-module-inset">';
            echo '<h4>'.$points[$i]["name"].'About</h4>';
            echo '<img src='.$points[$i]['picture_url'].' class="img-responsive" alt="Responsive image">';
            echo '<a href="https://www.google.com/maps/?q='.$points[$i]['latitude'].','.$points[$i]['longitude'].'" target="_blank">ver en Maps.</a>';
            echo '</div>';
        }
?>                 
        </div><!-- /.row -->';

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
