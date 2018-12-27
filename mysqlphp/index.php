<?php
  include_once('Model/Facturaciones.php');
  $Model = new Facturaciones(); 
?>
<!DOCTYPE html>
<html>
<head>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="Resource/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<title>Prueba Mysql - Php</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Prueba Mysql - PHP</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" 
	          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
	          aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="#" data-toggle="modal" data-target="#RegistrarProducto">Añadir Producto</a>
	      </li>
        <?php  
        $IdPedido = $Model->getLastPedido();
        if($IdPedido == -1)
        { 
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#CrearPedido">Crear Pedido</a>
        </li>
        <?php
        }else{
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#Pedido">Cerrar Pedido</a>
        </li>
        <?php  
        } 
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#RegistrarCliente">Registrar Cliente</a>
        </li>
	    </ul>
	  </div>
	</nav>
	<table id="dtBasicExample" class="table table-striped table-bordered" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Id
      </th>
      <th class="th-sm">Producto
      </th>
      <th class="th-sm">Descripción
      </th>
      <th class="th-sm">Valor
      </th>
      <th class="th-sm">Opciones
      </th>
    </tr>
  </thead>
  <?php
  $Productos = $Model->getAllProductos();
  if($Productos != null):
  foreach ($Productos as $Producto):
  ?>
  <tbody>
    <tr>
      <td><?php echo $Producto['idProducto']; ?></td>
      <td><?php echo $Producto['nombre']; ?></td>
      <td><?php echo $Producto['descripcion']; ?></td>
      <td>$ <?php echo number_format(($Producto['valor']),2,'.',','); ?></td>
      <td class="td-style">
        <?php  
        $IdPedido = $Model->getLastPedido();
        if($IdPedido == -1)
        { 
        ?>
        <a href="#" class="btn btn-success btn btn-sp" data-toggle="modal" data-target="#CrearPedido">
          <span class="glyphicon glyphicon-plus"></span>
        </a>
        <?php
        }else{
        ?>
        <a href="#" class="btn btn-success btn btn-sp" data-toggle="modal" data-target="#Detalle<?php echo $Producto['idProducto']; ?>">
          <span class="glyphicon glyphicon-plus"></span>
        </a>
        <?php  
        } 
        ?>
        <a href="#" class="btn btn-warning btn btn-sp" data-toggle="modal" data-target="#Editar<?php echo $Producto['idProducto']; ?>">
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a href="#" class="btn btn-danger btn btn-sp" data-toggle="modal" data-target="#Eliminar<?php echo $Producto['idProducto']; ?>">
          <span class="glyphicon glyphicon-trash"></span>
        </a>
      </td>
    </tr>
  </tbody>

  <!-- Inicio de modales -->
    <div class="modal" id="Detalle<?php echo $Producto['idProducto']; ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detalle producto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="Controller/AgregarProducto.php">
                <input type="hidden" name="IdProducto" value="<?php echo $Producto['idProducto']; ?>">
                <?php
                $IdPedido = $Model->getLastPedido();
                $DetallesProductosId = $Model->getDetallesProductosById($Producto['idProducto']);
                foreach ($DetallesProductosId as $DetalleProductoId){
                ?>
                <input type="hidden" name="IdVenta" value="<?php echo $IdPedido; ?>">
                <div class="form-group">
                  <label for="sel1">Nombre:</label>
                  <input class="form-control" type="text" name="Nombre" placeholder="Nombre del producto" value="<?php echo $DetalleProductoId['nombre']; ?>" readonly=#>  
                </div>
                <div class="form-group">
                  <label for="sel1">Descripción:</label>
                  <input class="form-control" type="text" name="Descripcion" placeholder="Descripcion del producto">
                </div>
                <div class="form-group">
                  <label for="sel1">Valor:</label>
                  <input class="form-control" type="number" name="Valor" placeholder="Valor" value="<?php echo $DetalleProductoId['valor']; ?>" readonly="">
                </div>
                <?php  
                $InformacionPedido = $Model->getLasPedidoInformacion($IdPedido);
                foreach ($InformacionPedido as $Info)
                {
                ?>
                <div class="form-group">
                  <label for="sel1">Descuento:</label>
                  <input class="form-control" type="text" name="Descuento" value="<?php echo $Info['descuento']; ?>%" readonly="">
                </div>
                <div class="form-group">
                  <label for="sel1">Iva:</label>
                  <input class="form-control" type="text" name="Iva" value="<?php echo $Info['iva']; ?>%" readonly="">
                </div> 
                <?php 
                }
                }
                ?>               
                <center>
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Agregar" name="Activar" class="btn btn-success">
                </center>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="Eliminar<?php echo $Producto['idProducto']; ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="Controller/EliminarProducto.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar producto</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type="hidden" name="Id" value="<?php echo $Producto['idProducto']; ?>">
            <div class="modal-body">
              ¿Estas seguro que deseas eliminar este producto?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
              <input type="submit" value="Eliminar" name="Activar" class="btn btn-danger">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal" id="Editar<?php echo $Producto['idProducto']; ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar producto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="Controller/EditarProducto.php">
                <input type="hidden" name="Id" value="<?php echo $Producto['idProducto']; ?>">
                <?php
                $ProductosId = $Model->getProductosById($Producto['idProducto']);
                foreach ($ProductosId as $ProductoId):
                ?>
                <div class="form-group">
                  <label for="sel1">Nombre:</label>
                  <input class="form-control" type="text" name="Nombre" placeholder="Nombre del producto" value="<?php echo $ProductoId['nombre']; ?>">  
                </div>
                <div class="form-group">
                  <label for="sel1">Descripción:</label>
                  <input class="form-control" type="text" name="Descripcion" placeholder="Descripcion del producto" value="<?php echo $ProductoId['descripcion']; ?>">
                </div>
                <div class="form-group">
                  <label for="sel1">Valor:</label>
                  <input class="form-control" type="number" name="Valor" placeholder="Valor" value="<?php echo $ProductoId['valor']; ?>">  
                </div> 
                <?php 
                endforeach;
                ?>               
                <center>
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Editar" name="Activar" class="btn btn-warning">
                </center>
            </form>
          </div>
        </div>
      </div>
    </div>

  <?php
  endforeach;
  endif;
  ?>
</table>

    <div class="modal" id="RegistrarProducto">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Registrar producto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="Controller/RegistrarProducto.php">
                <div class="form-group">
                  <label for="sel1">Nombre:</label>
                  <input class="form-control" type="text" name="Nombre" placeholder="Nombre del producto" autocomplete="off" required="">  
                </div>
                <div class="form-group">
                  <label for="sel1">Descripción:</label>
                  <input class="form-control" type="text" name="Descripcion" placeholder="Descripcion del producto" autocomplete="off" required="">
                </div>
                <div class="form-group">
                  <label for="sel1">Valor:</label>
                  <input class="form-control" type="number" name="Valor" placeholder="Valor" autocomplete="off" required="">  
                </div>                
                <center>
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Registrar" name="Activar" class="btn btn-success">
                </center>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php  
    $IdPedido = $Model->getLastPedido();
    if($IdPedido == -1)
    { 
    ?>
    <div class="modal" id="CrearPedido">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Realizar pedido</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="Controller/RegistrarPedido.php">
                <div class="form-group">
                  <label for="sel1">Consecutivo:</label>
                  <input readonly="" class="form-control" type="number" name="Consecutivo" autocomplete="off" placeholder="Consecutivo" value="<?php echo $Model->getLastConsecutivo()+1; ?>"> 
                </div>
                <div class="form-group">
                <label for="sel1">Seleccione cliente:</label>
                  <select class="form-control" name="Cliente">
                    <option>Seleccione</option>
                    <?php 
                    $Clientes = $Model->getClientes();
                    if($Clientes != null)
                    {
                    foreach ($Clientes as $Cliente) 
                    {
                    ?>
                    <option value="<?php echo $Cliente['idCliente']; ?>"><?php echo $Cliente['nombre']; ?></option>
                    <?php  
                    }
                    }

                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Fecha:</label>
                  <input class="form-control" type="text" name="Fecha" readonly="" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                  <label for="sel1">Hora:</label>
                  <input class="form-control" type="text" name="Hora" readonly="" value="<?php echo date('h:m'); ?>">  
                </div>
                <div class="form-group">
                  <label for="sel1">Iva:</label>
                  <input class="form-control" type="number" name="Iva" value="0.00">  
                </div>
                <div class="form-group">
                  <label for="sel1">Subtotal:</label>
                  <input class="form-control" type="number" name="Subtotal" placeholder="Subtotal" value="0.000" readonly="">  
                </div>
                <div class="form-group">
                  <label for="sel1">Descuento:</label>
                  <input class="form-control" type="number" name="Descuento" value="0.00">  
                </div>
                <div class="form-group">
                  <label for="sel1">Valor total:</label>
                  <input class="form-control" type="number" name="Total" value="0.000" readonly="">   
                </div>                
                <center>
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Crear Pedido" name="Activar" class="btn btn-success">
                </center>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php  
    }
    else
    {
    ?>
    <div class="modal" id="Pedido">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Cerrar Pedido</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="Controller/CerrarPedido.php">
                <?php  
                $IdPedido = $Model->getLastPedido();
                $InformacionPedido = $Model->getLasPedidoInformacion($IdPedido);
                $Subtotal = $Model->getSubtotal($IdPedido);
                foreach ($InformacionPedido as $Info) 
                {
                ?>
                <input type="hidden" name="IdCerrar" value="<?php echo $IdPedido; ?>">
                <div class="form-group">
                  <label for="sel1">Consecutivo:</label>
                  <input class="form-control" type="number" name="Consecutivo" autocomplete="off" placeholder="Consecutivo" value="<?php echo $Info['consecutivo'] ?>" readonly=""> 
                </div>
                <div class="form-group">
                <label for="sel1">Cliente:</label>
                  <input type="text" class="form-control" name="Cliente" value="<?php echo $Info['Cliente'] ?>" readonly="">
                </div>
                <div class="form-group">
                  <label for="sel1">Fecha:</label>
                  <input class="form-control" type="text" name="Fecha" readonly="" value="<?php echo $Info['fecha'] ?>">
                </div>
                <div class="form-group">
                  <label for="sel1">Hora:</label>
                  <input class="form-control" type="text" name="Hora" readonly="" value="<?php echo $Info['hora'] ?>">  
                </div>
                <div class="form-group">
                  <label for="sel1">Iva:</label>
                  <input class="form-control" type="number" name="Iva" value="<?php echo $Info['iva'] ?>">  
                </div>
                <div class="form-group">
                  <label for="sel1">Subtotal:</label>
                  <input class="form-control" type="number" name="Subtotal" value="<?php echo $Subtotal ?>" readonly="">  
                </div>
                <div class="form-group">
                  <label for="sel1">Descuento:</label>
                  <input class="form-control" type="number" name="Descuento" value="<?php echo $Info['descuento'] ?>">  
                </div>
                <div class="form-group">
                  <label for="sel1">Valor total:</label>
                  <?php 
                  $ValorConDescuento = ($Subtotal * $Info['descuento'])/100;
                  $ValorConIva = ($Subtotal * $Info['iva'])/100;
                  $ValorTotalNeto = 0;
                  $ValorTotalNeto = ($Subtotal-$ValorConDescuento)+$ValorConIva;
                  ?>
                  <input class="form-control" type="number" name="Total" value="<?php echo $ValorTotalNeto; ?>" readonly="">   
                </div>                
                <center>
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Cerrar Pedido" name="Activar" class="btn btn-success">
                </center>
                <?php 
                }
                ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php  
    }
    ?>
    <div class="modal" id="RegistrarCliente">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Registrar cliente</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="Controller/RegistrarCliente.php">
                <div class="form-group">
                  <label for="sel1">Nombre:</label>
                  <input class="form-control" type="text" name="Nombre" placeholder="Nombre del cliente">  
                </div>
                <div class="form-group">
                  <label for="sel1">Cedula:</label>
                  <input class="form-control" type="number" name="Documento" placeholder="Cedula del cliente">
                </div>              
                <center>
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Registrar" name="Activar" class="btn btn-success">
                </center>
            </form>
          </div>
        </div>
      </div>
    </div>

</body>
</html>