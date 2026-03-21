<?php

class Editorial {
      private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }
    public function verEditorial(){
    
    $sql="SELECT * FROM editoriales";

    $consulta=$this->conexion->prepare($sql);
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }    
    
}
?>
