<?php

require_once 'Conectar.php';

class Producto
{
    private $id_producto;
    private $descripcion;
    private $precio;
    private $costo;
    private $iscbp;
    private $id_empresa;
    private $ultima_salida;
    private $conectar;

    /**
     * Producto constructor.
     */
    public function __construct()
    {
        $this->conectar = conectar::getInstancia();
    }

    /**
     * @return mixed
     */
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * @param mixed $id_producto
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    /**
     * @return mixed
     */
    public function getIscbp()
    {
        return $this->iscbp;
    }

    /**
     * @param mixed $iscbp
     */
    public function setIscbp($iscbp)
    {
        $this->iscbp = $iscbp;
    }

    /**
     * @return mixed
     */
    public function getIdEmpresa()
    {
        return $this->id_empresa;
    }

    /**
     * @param mixed $id_empresa
     */
    public function setIdEmpresa($id_empresa)
    {
        $this->id_empresa = $id_empresa;
    }

    /**
     * @return mixed
     */
    public function getUltimaSalida()
    {
        return $this->ultima_salida;
    }

    /**
     * @param mixed $ultima_salida
     */
    public function setUltimaSalida($ultima_salida)
    {
        $this->ultima_salida = $ultima_salida;
    }

    public function insertar()
    {
        $sql = "insert into productos 
        values ('$this->id_producto', '$this->descripcion', '$this->precio', '$this->costo', '$this->iscbp', '$this->id_empresa', '$this->ultima_salida')";
        return $this->conectar->ejecutar_idu($sql);
    }

    public function modificar()
    {
        $sql = "update productos 
        set descripcion = '$this->descripcion', precio = '$this->precio', costo = '$this->costo', iscbp = '$this->iscbp'  
        where id_producto = '$this->id_producto'";
        echo $sql;
        return $this->conectar->ejecutar_idu($sql);
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id_producto) + 1, 1) as codigo 
            from productos";
        $this->id_producto = $this->conectar->get_valor_query($sql, 'codigo');
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from productos 
        where id_producto = '$this->id_producto'";
        $fila = $this->conectar->get_Row($sql);
        $this->descripcion = $fila['descripcion'];
        $this->precio = $fila['precio'];
        $this->costo = $fila['costo'];
        $this->iscbp = $fila['iscbp'];
        $this->id_empresa = $fila['id_empresa'];
        $this->ultima_salida = $fila['ultima_salida'];
    }

    public function verFilas()
    {
        $sql = "select * from productos where id_empresa = '$this->id_empresa'";
        return $this->conectar->get_Cursor($sql);
    }

    public function BuscarProductos($term)
    {
        $sql = "select * from productos 
        where id_empresa = '$this->id_empresa' and descripcion like '%$term%' 
        order by descripcion asc";
        return $this->conectar->get_Cursor($sql);
    }

}