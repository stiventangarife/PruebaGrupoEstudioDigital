<?php
  include_once('Model/Facturaciones.php');
  $Model = new Facturaciones(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Factura 02</title>
</head>
<body>
  <center>
  <h1>Factura</h1>
  <?php  
  $IdPedido = $Model->getLastPedidoFactura();
  if($IdPedido == -1)
  { 
  ?>
  <p>Error en el cierre de factura</p>
  <?php  
  }
  else
  {
  ?>
  <table border="1">
  	<?php  
    $IdPedido = $Model->getLastPedidoFactura();
    $InformacionPedido = $Model->getLasPedidoInformacionFactura($IdPedido);
    foreach ($InformacionPedido as $Info) 
    {
    ?>
   <tr>
    <th>Producto</th>
    <th>Precio</th>
    <th>Total</th>
   </tr>
   <?php  
	$IdPedido = $Model->getLastPedidoFactura();
	$InformacionProductosPedidp = $Model->getLasProductosPedidoInformacionFactura($IdPedido);
	foreach ($InformacionProductosPedidp as $InfoProduc) 
	{
	?>
   <tr>
    <td><?php echo $InfoProduc['nombre']; ?></td>
    <td><?php echo $InfoProduc['valor']; ?></td>
    <td><?php echo $InfoProduc['valor']; ?></td>
   </tr>
   <?php 
	}
   ?>
   <tr>
    <td colspan="2">Subtotal</td>
	<td><?php echo $Info['subtotal']; ?></td>
   </tr> 
   <tr>
    <td colspan="2">Iva</td>
	<td><?php echo $Info['iva']; ?>%</td>
   </tr> 
   <tr>
    <td colspan="2">Descuento</td>
	<td><?php echo $Info['descuento']; ?>%</td>
   </tr> 
   <tr>
    <td colspan="2">Precio total</td>
	<td><?php echo $Info['totalNeto']; ?></td>
   </tr> 
   <?php
	}
   ?>
  </table>
  <?php
	}
  ?>
	</br>
  <input type="submit" name="Imprimir" onclick='window.print();' value="Imprimir"></input>
  <a href="index.php">Volver</a>
  </center>
</body>
</html>