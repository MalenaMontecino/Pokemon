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
                        <a class="nav-link active" aria-current="page" href="http://localhost/Pokemon/PDO/index.php">Cromos existentes</a>
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




    <form id="miFormulario" class="position-absolute top-50 start-50 translate-middle mt-4" style="width: 800px;">

        <h1> Nuevo Pokémon </h1> <br>
        <!-- nombre -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre" placeholder="n">
            <label for="floatingNombre">Nombre Pokémon</label>
        </div>
        <!-- tipo -->

        <label for="tipo" class="form-label mb-3">Tipo</label> <br>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1">Agua</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
            <label class="form-check-label" for="inlineCheckbox2">Fuego</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
            <label class="form-check-label" for="inlineCheckbox3">Planta</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
            <label class="form-check-label" for="inlineCheckbox4">Eléctrico</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5">
            <label class="form-check-label" for="inlineCheckbox5">Lucha</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="option6">
            <label class="form-check-label" for="inlineCheckbox6">Volador</label>
        </div> <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox7" value="option7">
            <label class="form-check-label" for="inlineCheckbox7">Tierra</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox8" value="option8">
            <label class="form-check-label" for="inlineCheckbox8">Roca</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox9" value="option9">
            <label class="form-check-label" for="inlineCheckbox9">Veneno</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox10" value="option10">
            <label class="form-check-label" for="inlineCheckbox10">Psíquico</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox11" value="option11">
            <label class="form-check-label" for="inlineCheckbox11">Fantasma</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox12" value="option12">
            <label class="form-check-label" for="inlineCheckbox12">Bicho</label>
        </div> <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox13" value="option13">
            <label class="form-check-label" for="inlineCheckbox13">Normal</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox14" value="option14">
            <label class="form-check-label" for="inlineCheckbox14">Hielo</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox15" value="option15">
            <label class="form-check-label" for="inlineCheckbox15">Siniestro</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox16" value="option16">
            <label class="form-check-label" for="inlineCheckbox16">Hada</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox17" value="option17">
            <label class="form-check-label" for="inlineCheckbox17">Acero</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox18" value="option18">
            <label class="form-check-label" for="inlineCheckbox18">Dragón</label>
        </div>

        <!-- Región -->


        <select id="calificacionServicio" class="form-select mt-4" aria-label="Default select example">
            <option value="default" selected disabled>Región</option>
            <option value="kanto">Kanto</option>
            <option value="johto">Johto</option>
            <option value="hoenn">Hoenn</option>
            <option value="sinnoh">Sinnoh</option>
            <option value="unova">Unova</option>
            <option value="kalos">Kalos</option>
            <option value="alola">Alola</option>
            <option value="galar">Galar</option>
        </select> <br>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <!-- Imagen  -->
        <div class="mb-5">
            <label for="formFile" class="form-label">Seleccionar Imagen</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <!-- botón -->
        <div class="text-center "> <!-- para que me centre el botón -->
            <button type="button" class="btn btn-outline-secondary" onclick="calcularPropina()">Dar de alta</button>
        </div> <br><br>



    </form>

</body>

</html>