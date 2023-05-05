<?php require_once('views/header.php'); ?>
<div id="content">
    <form action="<?php echo constant('URL');?>estudios/searchEstudioByDescription" method="POST">
        <p>Busqueda de estudios:
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
        </p>
    </form>

    <table id="infoTable">
        <tr>
            <th>ID</th>
            <th>Clave</th>
            <th>Estudio de</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
        <?php
            include_once 'models/estudiosModel.php';
            foreach($this->datos as $estudio){
        ?>
        <tr>
            <td><?php echo $estudio->id; ?></td>
            <td><?php echo $estudio->clave_art; ?></td>
            <td><?php echo $estudio->descrip; ?></td>
            <td><?php echo $estudio->precio; ?></td>
            <td>
                <a href="editarCliente">Editar</a> <br>
                <a href="eliminarCliente">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <th>ID</th>
            <th>Clave</th>
            <th>Estudio de</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
    </table>
</div>
<?php require_once('views/footer.php'); ?>