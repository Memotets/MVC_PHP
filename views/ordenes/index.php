<?php require_once('views/header.php'); ?>
<?php
    if ($this->response != "") {
        echo "<script>alert('".$this->response."');</script>";
    }
?>
<div id="content" class="second-content">
    <div id="form-content">
        <h1>Ordenes</h1><br>
        <form action="<?php echo constant('URL');?>ordenes/realizarOrdenes" method="POST">
            <p class="pForm">Llenado de folio:
            <input type="text" placeholder="230101000x" name="folio">

            Selecionar cliente:
                <select name="cliente" id="cliente">
                    <?php
                        include_once 'models/clientesModel.php';
                        foreach($this->clientes as $cliente){
                    ?>
                    <option value="<?php echo $cliente->clave_cli; ?>"><?php echo $cliente->nombre; ?></option>
                    <?php } ?>
                </select>
            </p>
            <div>
            <p>Selecionar estudios:</p>
            <table id="selectTable">
                <tr>
                    <th>Clave</th>
                    <th>Estudio de</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>
                <?php
                    include_once 'models/estudiosModel.php';
                    foreach($this->estudios as $estudio){
                ?>
                <tr>
                    <td><?php echo $estudio->clave_art; ?></td>
                    <td><?php echo $estudio->descrip; ?></td>
                    <td><?php echo $estudio->precio; ?></td>
                    <td>
                        <input type="checkbox" name="estudios[]" value="<?php echo $estudio->clave_art.'-'.$estudio->precio;  ?>"> Agregar <br> 
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th>Clave</th>
                    <th>Estudio de</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>
            </table>
            </div>

            <p class="pFormRight">valor total de la orden: <span id="total" name="total"></span></p>
            <button type="submit">Crear orden</button>
            
        </form>
    </div>
</div>

<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const totalElement = document.getElementById('total');
    let total = 0;

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
        let value = this.value.split('-');
        this.value 
        if (this.checked) {
            total += parseInt(value[1]);
        } else {
            total -= parseInt(value[1]);
        }
        totalElement.textContent = total;
        });
    });
</script>
<?php require_once('views/footer.php'); ?>