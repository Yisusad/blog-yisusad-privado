<!--=====================================
MENU
======================================-->

<div class="container-fluid menu">

	<a href="#" class="btnClose">X</a>

	<ul class="nav flex-column text-center">

	<?php 
		$listaCategorias = array();

		// Recopilar categorías únicas
		// Iterar sobre los artículos
		foreach ($totalArticulos as $articulo) {
			// Iterar sobre las categorías
			foreach ($categorias as $categoria) {
				// Si la categoría del artículo coincide con la categoría actual
				if ($articulo["id_cat"] == $categoria["id_categoria"]) {
					// Si la categoría no está en la lista, añadirla
					$listaCategorias[$categoria["id_categoria"]] = $categoria;
				}
			}
		}
	?>

	<?php foreach($listaCategorias as $categoria) :?>

		<li class="nav-item">
			<a class="nav-link text-white" href="<?php echo $blog["dominio"] . $categoria["ruta_categoria"]; ?>">
				<?php echo $categoria["descripcion_categoria"]; ?>
			</a>
		</li>

	<?php endforeach ?>

	</ul>

</div>
