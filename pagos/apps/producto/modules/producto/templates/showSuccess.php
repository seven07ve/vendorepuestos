<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $producto->getId() ?></td>
    </tr>
    <tr>
      <th>Titulo:</th>
      <td><?php echo $producto->getTitulo() ?></td>
    </tr>
    <tr>
      <th>Subtitulo:</th>
      <td><?php echo $producto->getSubtitulo() ?></td>
    </tr>
    <tr>
      <th>Foto1:</th>
      <td><?php echo $producto->getFoto1() ?></td>
    </tr>
    <tr>
      <th>Foto2:</th>
      <td><?php echo $producto->getFoto2() ?></td>
    </tr>
    <tr>
      <th>Foto3:</th>
      <td><?php echo $producto->getFoto3() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $producto->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Id estado:</th>
      <td><?php echo $producto->getIdEstado() ?></td>
    </tr>
    <tr>
      <th>Id ciudad:</th>
      <td><?php echo $producto->getIdCiudad() ?></td>
    </tr>
    <tr>
      <th>Condicion:</th>
      <td><?php echo $producto->getCondicion() ?></td>
    </tr>
    <tr>
      <th>Precio:</th>
      <td><?php echo $producto->getPrecio() ?></td>
    </tr>
    <tr>
      <th>Vence:</th>
      <td><?php echo $producto->getVence() ?></td>
    </tr>
    <tr>
      <th>Id categoria:</th>
      <td><?php echo $producto->getIdCategoria() ?></td>
    </tr>
    <tr>
      <th>Id menu:</th>
      <td><?php echo $producto->getIdMenu() ?></td>
    </tr>
    <tr>
      <th>Id submenu:</th>
      <td><?php echo $producto->getIdSubmenu() ?></td>
    </tr>
    <tr>
      <th>Id submenu2:</th>
      <td><?php echo $producto->getIdSubmenu2() ?></td>
    </tr>
    <tr>
      <th>Id paquete usuario:</th>
      <td><?php echo $producto->getIdPaqueteUsuario() ?></td>
    </tr>
    <tr>
      <th>Usuario tienda:</th>
      <td><?php echo $producto->getUsuarioTienda() ?></td>
    </tr>
    <tr>
      <th>Id usuario tienda:</th>
      <td><?php echo $producto->getIdUsuarioTienda() ?></td>
    </tr>
    <tr>
      <th>Fecha publicacion:</th>
      <td><?php echo $producto->getFechaPublicacion() ?></td>
    </tr>
    <tr>
      <th>Visitas:</th>
      <td><?php echo $producto->getVisitas() ?></td>
    </tr>
    <tr>
      <th>Ultima visita:</th>
      <td><?php echo $producto->getUltimaVisita() ?></td>
    </tr>
    <tr>
      <th>Oferta dia:</th>
      <td><?php echo $producto->getOfertaDia() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('producto/edit?id='.$producto->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('producto/index') ?>">List</a>
