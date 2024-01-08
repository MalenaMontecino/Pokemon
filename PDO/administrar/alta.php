<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de cromos</title>

    <link rel="stylesheet" href="/PDO/css/formulario.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">

        <div class="container-fluid">
            <!--LOGO-->
            <a class="navbar-brand" style="background-image: url(/images/pokemon_logo.png);" href="#">LOGO</a>
            <!--BUTTON DESPLEGABLE-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--SUB-ELECCIONES-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--HOME-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Cromos existentes</a>
                    </li>
                    <!--LINK
            <li class="nav-item">
                <a class="nav-link" href="#">Dar de alta</a>
            </li>-->

                    <!--SELECT-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="modificar.php">Modificar datos</a></li>
                            <li><a class="dropdown-item" href="alta.php">Dar de alta</a></li>
                            <li><a class="dropdown-item" href="eliminar.php">Eliminar </a></li>
                        </ul>
                    </li>

                </ul>
                <!--BUSCAR-->
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>

            </div>

        </div>
    </nav>




    <form id = "miFormulario" class="position-absolute top-50 start-50 translate-middle" style="width: 800px">

      <h1> CALCULA UNA PROPINA JUSTA </h1> <br><br>

      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numPersonas" placeholder="n">
        <label for="floatingPersonas">Número de personas</label>
      </div>
      
      <div class="form-floating">
        <input type="number" class="form-control" id="coste" placeholder="c">
        <label for="floatingCoste">Coste total</label>
      </div> <br>
      
      <label for="selecciona" class="form-label">Califica el servicio recibido</label>
      <select id ="calificacionServicio" class="form-select" aria-label="Default select example" >
        <option value ="default" selected disabled>Desplegar menú</option> 
        <option value="genial">Genial</option>
        <option value="aceptable">Aceptable</option>
        <option value="horrible">Horrible</option>
      </select> <br><br>
      
      
      <div class="text-center"> <!-- para que me centre el botón -->
       <button type="button" class="btn btn-outline-secondary" onclick="calcularPropina()">CALCULAR</button>
      </div> <br><br>

    
     
     <p> Propina por persona </p>
     <p id= "propina"></p>
      <p> ________________ </p>

   </form>

</body>

</html>