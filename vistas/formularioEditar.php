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

        h1, p {
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
        
        #imagen_actual {
            margin-top: 10px;
        }
    </style>

</head>
<body>
<div class="container mt-5 card">
    <div class="d-flex justify-content-center">
        <h1>Editar los datos del automovil</h1>
    </div>
    <p>Atencion! No se permiten campos vacios en este punto.</p>
    <form action="../controladores/autos.controlador.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="opcion" value="actualizarAuto">
        <input type="hidden" name="id" id="id_auto">
        <div>
            <label for="marca" class="label">Marca</label>
            <input id="marca" placeholder="ejemplo: Toyota" name="marca" type="text" class="form-control mb-4" required> 
        </div>  
        <div>
            <label for="modelo" class="label">Modelo</label>
            <input id="modelo" placeholder="ejemplo: 4Runner 2023" name="modelo" type="text" class="form-control mb-4" required> 
        </div>  
        <div>
            <label for="color" class="label">Color</label>
            <input id="color" placeholder="ejemplo: Gris" name="color" type="text" class="form-control mb-4" required> 
        </div>    
        <div>
            <label for="precio" class="label">Precio</label>
            <input id="precio" placeholder="ejemplo: 30000" name="precio" type="text" class="form-control mb-4" required> 
        </div>  
        <div>
            <label for="imagen" class="label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
            <small class="text-white">Deja vacío para mantener la imagen actual</small>
            <div id="imagen_actual" class="mt-2">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-warning mt-4">Actualizar</button>
            <a href="./lista_de_autos.php" class="btn btn-primary mt-4">Regresar</a>
        </div>    
        <div>
        </div>
    </form>

</div>

<script>
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

document.addEventListener('DOMContentLoaded', function() {
    var idAuto = getUrlParameter('id');
    if (idAuto) {
        document.getElementById('id_auto').value = idAuto;
        cargarDatosAuto(idAuto);
    } else {
        alert('No se especificó un ID de auto para editar');
        window.location.href = 'lista_de_autos.php';
    }
});

function cargarDatosAuto(id) {
    var data = new FormData();
    data.append("opcion", "obtenerAutoPorId");
    data.append("id", id);
    
    fetch("../controladores/autos.controlador.php", {
        method: "POST",
        body: data
    })
    .then(response => response.json())
    .then(auto => {
        if (auto) {
            document.getElementById('marca').value = auto.marca || '';
            document.getElementById('modelo').value = auto.modelo || '';
            document.getElementById('color').value = auto.color || '';
            document.getElementById('precio').value = auto.precio || '';
            
            var imagenActualDiv = document.getElementById('imagen_actual');
            if (auto.imagen && auto.imagen.trim() !== '') {
                imagenActualDiv.innerHTML = `
                    <div class="mt-2">
                        <label class="label">Imagen actual:</label>
                        <img src="../publico/imagenes/${auto.imagen}" alt="Imagen actual" 
                             class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                    </div>`;
            } else {
                imagenActualDiv.innerHTML = '<small class="text-white">No hay imagen actual</small>';
            }
        } else {
            alert('No se pudo cargar la información del auto');
        }
    })
    .catch(error => {
        alert('Error al cargar la información del auto');
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>