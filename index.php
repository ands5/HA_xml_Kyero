<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Propiedades</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Propiedades</h1>
        <?php
        // Cargar el archivo XML
        $xml = simplexml_load_file('property.xml') or die("Error: No se pudo cargar el archivo XML.");

        // Iterar sobre cada propiedad
        foreach ($xml->property as $index => $property) {
            echo '<div class="card mb-4">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $property->type . ' en ' . $property->town . ', ' . $property->province . '</h5>';
            echo '<p class="card-text"><strong>Precio:</strong> ' . $property->price . ' ' . $property->currency . '</p>';
            echo '<p class="card-text"><strong>Descripción:</strong> ' . $property->desc->es . '</p>';

            // Convertir características en un array y luego usar implode
            $featuresArray = [];
            foreach ($property->features->feature as $feature) {
                $featuresArray[] = (string)$feature;
            }
            echo '<p class="card-text"><strong>Características:</strong> ' . implode(', ', $featuresArray) . '</p>';

            echo '<p class="card-text"><strong>Superficie Construida:</strong> ' . $property->surface_area->built . ' m²</p>';
            echo '<p class="card-text"><strong>Habitaciones:</strong> ' . $property->beds . '</p>';
            echo '<p class="card-text"><strong>Baños:</strong> ' . $property->baths . '</p>';
            echo '</div>';
            echo '</div>';

            // Mostrar las imágenes en un carrusel
            echo '<div id="carousel' . $index . '" class="carousel slide mb-4" data-ride="carousel">';
            echo '<div class="carousel-inner">';

            $firstImage = true;
            foreach ($property->images->image as $image) {
                echo '<div class="carousel-item' . ($firstImage ? ' active' : '') . '">';
                echo '<img src="' . $image->url . '" class="d-block w-100" alt="Imagen de la propiedad">';
                echo '</div>';
                $firstImage = false;
            }

            echo '</div>';
            echo '<a class="carousel-control-prev" href="#carousel' . $index . '" role="button" data-slide="prev">';
            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
            echo '<span class="sr-only">Anterior</span>';
            echo '</a>';
            echo '<a class="carousel-control-next" href="#carousel' . $index . '" role="button" data-slide="next">';
            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
            echo '<span class="sr-only">Siguiente</span>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
