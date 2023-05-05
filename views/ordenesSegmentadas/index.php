<?php require_once('views/header.php'); ?>
<div id="content">
    <form action="<?php echo constant('URL');?>ordenesSegmentadas/searchOrdenesPartidasByFolio" method="POST">
        <p>Busqueda de orden especifica por folio:
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
        </p>
    </form>

    <table id="infoTable">
        <tr>
            <th>ID</th>
            <th>Venta</th>
            <th>Articulo</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
        <?php
            include_once 'models/ordenesModel.php';
            foreach($this->datos as $orden){
        ?>
        <tr>
            <td><?php echo $orden->id; ?></td>
            <td><?php echo $orden->venta; ?></td>
            <td><?php echo $orden->articulo; ?></td>
            <td><?php echo $orden->precioUnitario; ?></td>
            <td>
                <a href="editarCliente">Editar</a> <br>
                <a href="eliminarCliente">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <th>ID</th>
            <th>Venta</th>
            <th>Articulo</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
    </table>
</div>
<?php require_once('views/footer.php'); ?>