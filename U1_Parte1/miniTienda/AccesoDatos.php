<?php

class Ticket{
    private $producto;
    private $precioU;
    private $cantidad;
    private $total;

    function __construct($p,$pU,$c){
        $this->producto=$p;
        $this->precioU=$pU;
        $this->cantidad=$c;
        $this->total=$pU*$c;
    }

    function insertarProducto(Ticket $t){
        try{
            //Abrir el fichero
            $fichero = fopen($this->nombre,'a+');

            //Insertar al final
            fwrite($fichero, $t->getProducto().';'.$t->getPrecioU().';'.$t->getCantidad().
                ';'.$t->getTotal().PHP_EOL);

        }
        catch(Throwable $e){
            echo  $e->getMessage();
        }
        finally{
            //Cerrar el fichero
            if(isset($fichero))
                fclose($fichero);
        }
        
    }

    function obtenerProductos(){
        $resultado=array();
        try{
             //Cargamos el fichero en un array
            if(file_exists($this->nombre)){
                $tmp = file($this->nombre);
                foreach($tmp as $linea){
                    $campos=explode(';',$linea);
                    //Crear objeto ticket
                    $t=new Ticket($campos[0],$campos[1],$campos[2]);
                    //añadimos $t al array de objetos resultado
                    $resultado[]=$t;
                }
            }
        }
        catch(Throwable $e){
            echo $e->getMessage();
        }
        return $resultado;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}
?>