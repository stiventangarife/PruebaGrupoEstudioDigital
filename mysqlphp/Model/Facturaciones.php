<?php  

class Facturaciones
{
	private $pdo;
	private $driver = "mysql";
    private $host = 'localhost';
    private $bd = 'facturacion';
    private $usuario = 'root';
    private $contrasena = ''; 
    private $charset = "utf8";

	protected function connection() 
    {
        try
        {
            $pdo = new PDO("{$this->driver}:host={$this->host};dbname={$this->bd};charset={$this->charset}",$this->usuario, $this->contrasena);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(PDOException $e)
        {
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    } 

	public function __construct()
	{
		$this->pdo = self::connection();
	}

     public function getLasProductosPedidoInformacionFactura($Id)
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT P.nombre, P.valor FROM detalleventa DV INNER JOIN productos P ON P.idProducto = DV.idProducto WHERE idVenta = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }

        return $rows;
    }

    public function getLasPedidoInformacionFactura($Id)
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT * FROM ventas WHERE idVenta = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }

        return $rows;
    }

    public function getLastPedidoFactura()
    {
        $statement = $this->pdo->prepare("SELECT MAX(idVenta) as Id FROM ventas WHERE subtotal > 0 AND totalNeto > 0 LIMIT 1");
        $statement->execute();
        $datos = $statement->fetch();
        return $datos['Id'] > 0 ? $datos['Id'] : -1;
    }

    public function closeVenta($Id, $SubTotal, $TotalNeto)
    {
        $statement = $this->pdo->prepare("UPDATE ventas SET subtotal = :SubTotal, totalNeto = :TotalNeto WHERE idVenta = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->bindParam(':SubTotal', $SubTotal);
        $statement->bindParam(':TotalNeto', $TotalNeto);
        if ($statement->execute()) 
        {
            header('Location: ../Factura.php');
        }   
        else
        {
            header('Location: ../index.php');
        }   
    } 

    public function getSubtotal($Id)
    {
        $statement = $this->pdo->prepare("SELECT SUM(valor) as subtotal FROM detalleventa WHERE idVenta = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        $datos = $statement->fetch();
        return $datos['subtotal'];
    }

    public function createDetalleProducto($IdVenta, $IdProducto, $Descripcion, $Valor, $Descuento, $Iva, $Total)
    {
        $statement = $this->pdo->prepare("INSERT INTO detalleventa(idVenta, idProducto, descripcion, valor, descuento, iva, total) VALUES (:IdVenta, :IdProducto, :Descripcion, :Valor, :Descuento, :Iva, :Total)");
        $statement->bindParam(':IdVenta', $IdVenta);
        $statement->bindParam(':IdProducto', $IdProducto);
        $statement->bindParam(':Descripcion', $Descripcion);
        $statement->bindParam(':Valor', $Valor);
        $statement->bindParam(':Descuento', $Descuento);
        $statement->bindParam(':Iva', $Iva);
        $statement->bindParam(':Total', $Total);
        if ($statement->execute()) 
        {
            header('Location: ../index.php');
        }   
        else
        {
            header('Location: ../index.php');
        }   
    }

    public function getDetallesProductosById($Id)
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT * FROM productos WHERE idProducto = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }

        return $rows;
    }

    public function getLastPedido()
    {
        $statement = $this->pdo->prepare("SELECT MAX(idVenta) as Id FROM ventas WHERE subtotal = 0 AND totalNeto = 0 LIMIT 1");
        $statement->execute();
        $datos = $statement->fetch();
        return $datos['Id'] > 0 ? $datos['Id'] : -1;
    }

    public function getLasPedidoInformacion($Id)
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT C.nombre AS Cliente, V.consecutivo, V.fecha, V.hora, V.subtotal, V.descuento, V.iva, V.totalNeto FROM ventas V INNER JOIN clientes C ON C.idCliente = V.idCliente WHERE V.idVenta = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }

        return $rows;
    }

    public function getLastConsecutivo()
    {
        $statement = $this->pdo->prepare("SELECT MAX(consecutivo) as Consecutivo FROM ventas");
        $statement->execute();
        $datos = $statement->fetch();
        return $datos['Consecutivo'];
    }

    public function getAllProductos()
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT * FROM productos");
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }
        return $rows;
    }

    public function getProductosById($Id)
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT * FROM productos WHERE idProducto = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }
        return $rows;
    }

    public function createProducto($Nombre, $Descripcion, $Valor)
    {
        $statement = $this->pdo->prepare("INSERT INTO productos(nombre, descripcion, valor) VALUES (:Nombre, :Descripcion, :Valor)");
        $statement->bindParam(':Nombre', $Nombre);
        $statement->bindParam(':Descripcion', $Descripcion);
        $statement->bindParam(':Valor', $Valor);
        if ($statement->execute()) 
        {
            header('Location: ../index.php');
        }   
        else
        {
            header('Location: ../index.php');
        }   
    }

    public function createPedido($Consecutivo, $idCliente, $Fecha, $Hora, $Iva, $Subtotal, $Descuento, $Total)
    {
        $statement = $this->pdo->prepare("INSERT INTO ventas(consecutivo, idCliente, fecha, hora, subtotal, descuento, iva, totalNeto) VALUES (:Consecutivo, :idCliente, :Fecha, :Hora, :Subtotal, :Descuento, :Iva, :Total)");
        $statement->bindParam(':Consecutivo', $Consecutivo);
        $statement->bindParam(':idCliente', $idCliente);
        $statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Hora', $Hora);
        $statement->bindParam(':Subtotal', $Subtotal);
        $statement->bindParam(':Descuento', $Descuento);
        $statement->bindParam(':Iva', $Iva);
        $statement->bindParam(':Total', $Total);
        $statement->execute();   
        header('Location: ../index.php');
    }

    public function createCliente($Nombre, $Documento)
    {
        $statement = $this->pdo->prepare("INSERT INTO clientes(nombre, documento) VALUES (:Nombre, :Documento)");
        $statement->bindParam(':Nombre', $Nombre);
        $statement->bindParam(':Documento', $Documento);
        if ($statement->execute()) 
        {
            header('Location: ../index.php');
        }   
        else
        {
            header('Location: ../index.php');
        }   
    }

    public function deleteProducto($Id)
    {
        $statement = $this->pdo->prepare("DELETE FROM productos WHERE idProducto = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
        header('Location: ../index.php');
    } 

    public function updateProducto($Id, $Nombre, $Descripcion, $Valor)
    {
        $statement = $this->pdo->prepare("UPDATE productos SET nombre = :Nombre, descripcion = :Descripcion, valor = :Valor WHERE idProducto = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->bindParam(':Nombre', $Nombre);
        $statement->bindParam(':Descripcion', $Descripcion);
        $statement->bindParam(':Valor', $Valor);
        if ($statement->execute()) 
        {
            header('Location: ../index.php');
        }   
        else
        {
            header('Location: ../index.php');
        }   
    }  

    public function getClientes()
    {
        $rows = null;
        $statement = $this->pdo->prepare("SELECT * FROM clientes");
        $statement->execute();
        while($result = $statement->fetch())
        {
            $rows[] = $result;
        }
        return $rows;
    }

}
?>