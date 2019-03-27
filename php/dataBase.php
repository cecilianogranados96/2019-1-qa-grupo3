<?php
    class dataBase
    {
        var $host;
        var $bd;
        var $usuario;
        var $password;
        var $link;
        
        public function __construct()
        {
            $this->host='localhost';
            $this->bd='baseqa';
            $this->usuario='root';
            $this->password='';
            $this->link = new mysqli($this->host, $this->usuario, $this->password, $this->bd);
        }
        
        public function consultar($sql)
        {
            //$mysqli = new mysqli($this->host, $this->usuario, $this->password, $this->bd);
            $result = $this->link->query($sql);
            // $result = mysqli_fetch_array($result);
            return $result;
            // $datos_bd = "host=$this->host port=5432 dbname=$this->bd user=$this->usuario password=$this->password";
            // $link = pg_connect($datos_bd);
            // $this->link = $link;
            // $query = pg_query($link,$sql);
            // if (!empty($query))
            // {
            //     return $query;
            // }
            // else
            // {
            //     echo "Error!!!";
            // }
        }
        
        public function insertar($sql)
        {

            return $this->link->query($sql);
            // $datos_bd = "host=$this->host port=5432 dbname=$this->bd user=$this->usuario password=$this->password";
            // $link = pg_connect($datos_bd);
            // $this->link = $link;
            // $query = pg_query($link,$sql);
            // if (!empty($query))
            // {
            //     echo "Se ha insertado correctamente";
                
            // }
            // else
            // {
            //     echo "Error!!!";
            // }
        }
        
        public function __destruct()
        {
            // pg_close($this->link);
            mysqli_close($this->link);
        }
        //Ejecuta cualquier consulta en la base de datos y tambien transacciones
    }

?>