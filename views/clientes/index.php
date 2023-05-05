<?php require_once('views/header.php'); ?>
<div id="content">
    <form action="<?php echo constant('URL');?>clientes/searchClienteByName" method="POST">
        <p>Busqueda de clientes:
        <input type="text" placeholder="Buscar por nombre..." name="search" required>
        <button type="submit"><i class="fa fa-search"></i></button>
        </p>
    </form>

    <table id="infoTable">
        <tr>
            <th>ID</th>
            <th>Clave</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php
            include_once 'models/clientesModel.php';
            foreach($this->datos as $cliente){
        ?>
        <tr>
            <td><?php echo $cliente->id; ?></td>
            <td><?php echo $cliente->clave_cli; ?></td>
            <td><?php echo $cliente->nombre; ?></td>
            <td><?php echo $cliente->email; ?></td>
            <td>
                <a href="editarCliente">Editar</a> <br>
                <a href="eliminarCliente">Eliminar</a>
            </td>
        </tr>
        <?php } ?>

        <tr>
            <th>ID</th>
            <th>Clave</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        
    </table>
</div>
<?php require_once('views/footer.php'); ?>