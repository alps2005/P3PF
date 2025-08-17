<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de automoviles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("../publico/bg_list.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        h2 {
            color: rgba(0, 115, 255, 0.95);
            font-style: bold;
        }

        .tablecont {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 50px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .card-img-top {
            border-top-left-radius: calc(0.375rem - 1px);
            border-top-right-radius: calc(0.375rem - 1px);
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .card-text {
            color: #7f8c8d;
        }

        .list-group-item {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }
        
    </style>
</head>
<body class="container mt-5 tablecont">
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Lista de Autos</h2>
            <a href="formulario.php" class="btn btn-success btn-lg">
                <i class="fas fa-plus"></i> Agregar Auto
            </a>
        </div>
    </div>
    <div class="row" id="content">
    </div>
    <script>
        var data = new FormData();
        data.append("opcion", "obtenerAutos");
        fetch("../controladores/autos.controlador.php", {
            method: "POST",
            body: data
        }).then(response => response.json())
        .then(response => {
            var contentDiv = document.getElementById('content');
            var content = '';
            
            if (response.length === 0) {
                content = `
                <div class="col-12 text-center">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">No hay autos disponibles</h4>
                        <p>Agrega tu primer auto haciendo clic en el botón "Agregar" de arriba.</p>
                    </div>
                </div>`;
            } else {
                for(var i = 0; i < response.length; i++){
                    content += `
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100" style="width: 100%;">
                            <img src="../publico/imagenes/${response[i]["imagen"]}" class="card-img-top" alt="${response[i]["modelo"]} width="50px">
                            <div class="card-body">
                                <h5 class="card-title">${response[i]["marca"]} ${response[i]["modelo"]}</h5>
                                <p class="card-text">Color: ${response[i]["color"]}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Precio: $${response[i]["precio"]}</li>
                            </ul>
                            <div class="card-body row">
                                <a href="./formularioEditar.php?id=${response[i]["id"]}" class="btn btn-primary mb-3">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <button onclick="eliminarAuto(${response[i]["id"]})" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>`;
                };
            }
            contentDiv.innerHTML = content;

        });

        function eliminarAuto(id) {
            if (confirm('¿Está seguro de que desea eliminar este auto?')) {
                var data = new FormData();
                data.append("opcion", "eliminarAuto");
                data.append("id", id);
                
                fetch("../controladores/autos.controlador.php", {
                    method: "POST",
                    body: data
                }).then(response => response.text())
                .then(response => {
                    if (response === "ok") {
                        alert('Auto eliminado exitosamente');
                        location.reload();
                    } else if (response.startsWith("error:")) {
                        alert('Error al eliminar el auto: ' + response.substring(6));
                    } else {
                        alert('Error al eliminar el auto: ' + response);
                    }
                })
                .catch(error => {
                    alert('Error al eliminar el auto');
                });
                    }
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>