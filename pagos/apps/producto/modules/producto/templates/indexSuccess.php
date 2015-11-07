<h1>Productos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Titulo</th>
      <th>Subtitulo</th>
      <th>Foto1</th>
      <th>Foto2</th>
      <th>Foto3</th>
      <th>Descripcion</th>
      <th>Id estado</th>
      <th>Id ciudad</th>
      <th>Condicion</th>
      <th>Precio</th>
      <th>Vence</th>
      <th>Id categoria</th>
      <th>Id menu</th>
      <th>Id submenu</th>
      <th>Id submenu2</th>
      <th>Id paquete usuario</th>
      <th>Usuario tienda</th>
      <th>Id usuario tienda</th>
      <th>Fecha publicacion</th>
      <th>Visitas</th>
      <th>Ultima visita</th>
      <th>Oferta dia</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($productos as $producto): ?>
    <tr>
      <td><a href="<?php echo url_for('producto/show?id='.$producto->getId()) ?>"><?php echo $producto->getId() ?></a></td>
      <td><?php echo $producto->getTitulo() ?></td>
      <td><?php echo $producto->getSubtitulo() ?></td>
      <td><?php echo $producto->getFoto1() ?></td>
      <td><?php echo $producto->getFoto2() ?></td>
      <td><?php echo $producto->getFoto3() ?></td>
      <td><?php echo $producto->getDescripcion() ?></td>
      <td><?php echo $producto->getIdEstado() ?></td>
      <td><?php echo $producto->getIdCiudad() ?></td>
      <td><?php echo $producto->getCondicion() ?></td>
      <td><?php echo $producto->getPrecio() ?></td>
      <td><?php echo $producto->getVence() ?></td>
      <td><?php echo $producto->getIdCategoria() ?></td>
      <td><?php echo $producto->getIdMenu() ?></td>
      <td><?php echo $producto->getIdSubmenu() ?></td>
      <td><?php echo $producto->getIdSubmenu2() ?></td>
      <td><?php echo $producto->getIdPaqueteUsuario() ?></td>
      <td><?php echo $producto->getUsuarioTienda() ?></td>
      <td><?php echo $producto->getIdUsuarioTienda() ?></td>
      <td><?php echo $producto->getFechaPublicacion() ?></td>
      <td><?php echo $producto->getVisitas() ?></td>
      <td><?php echo $producto->getUltimaVisita() ?></td>
      <td><?php echo $producto->getOfertaDia() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('producto/new') ?>">New</a>
