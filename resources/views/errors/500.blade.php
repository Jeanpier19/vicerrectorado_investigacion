<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 Server Error</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('errors/500/css/main.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('errors/500/css/font-awesome.min.css') }}"/>
  </head>
  <body>
    <div id="notfound">
      <div class="notfound-bg"></div>
      <div class="notfound">
        <div class="notfound-404">
          <h1>500</h1>
        </div>
        <h2>La Página Está Fuera de Servicio</h2>
        <form class="notfound-search">
          <input type="text" placeholder="Buscar...">
          <button type="button">Buscar</button>
        </form>
        <div class="notfound-social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-instagram"></i></a>
          <a href="#"><i class="fa fa-youtube"></i></a>
        </div>
        <a href="{{ route('web.index') }}">Volver a la Página de Inicio</a>
      </div>
    </div>
  </body>
</html>