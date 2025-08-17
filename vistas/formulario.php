<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del auto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>

    <style>
        body {
            background-image: url("../publico/bg_list.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        h1 {
            color: black;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 50px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .label {
            color: black;
            weight: 5px;
            margin-bottom: 5px;
        }
        
        .img-thumbnail {
            border: 2px solid black;
            border-radius: 8px;
        }
        
        #imagen_preview {
            margin-top: 10px;
        }
    </style>

</head>
<body>
<div class="container mt-5 card">
    <div class="d-flex justify-content-center">
        <h1>Ingrese los datos del automovil</h1>
    </div>
    <form action="../controladores/autos.controlador.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="opcion" value="insertarAuto">
        <div>
            <label for="marca" class="label">Marca</label>
            <input id="marca" placeholder="ejemplo: Toyota" name="marca" type="text" class="form-control mb-4"> 
        </div>  
        <div>
            <label for="modelo" class="label">Modelo</label>
            <input id="modelo" placeholder="ejemplo: 4Runner 2023" name="modelo" type="text" class="form-control mb-4"> 
        </div>  
        <div>
            <label for="color" class="label">Color</label>
            <input id="color" placeholder="ejemplo: Gris" name="color" type="text" class="form-control mb-4"> 
        </div>    
        <div>
            <label for="precio" class="label">Precio</label>
            <input id="precio" placeholder="ejemplo: 30000" name="precio" type="text" class="form-control mb-4"> 
        </div>  
        <div>
            <label for="imagen" class="label">Imagen</label>
            <input type="file" name="imagen" class="form-control" accept="image/*" onchange="previewImage(this)">
            <div id="imagen_preview" class="mt-2">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-success mt-4">Guardar</button>
            <a href="./lista_de_autos.php" class="btn btn-warning mt-4">Regresar</a>
        </div>    
        <div>
        </div>
    </form>

</div>

<script>
function previewImage(input) {
    var preview = document.getElementById('imagen_preview');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="mt-2">
                    <label class="label">Vista previa:</label>
                    <img src="${e.target.result}" alt="Vista previa" 
                         class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                </div>`;
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.innerHTML = '';
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>