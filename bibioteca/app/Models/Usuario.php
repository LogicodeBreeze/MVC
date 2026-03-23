<?php

class Usuario {
      private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    
        }


    public function iniciarSesion($nombreUsuario){

    $query="SELECT * FROM usuarios WHERE nombreUsuario = ?";

    $consulta= $this->conexion->prepare($query);

    $consulta->execute([$nombreUsuario]);

    return $consulta->fetch(PDO::FETCH_ASSOC);
    } 

    public function registro($nombreUsuario,$email,$password){
        $sql="INSERT INTO usuarios (nombreUsuario, email, password) 
            VALUES (:nombre,:email,:contranya)";//parametros que se pasa

            $consulta=$this->conexion->prepare($sql);
            $consulta->bindParam("nombre",$nombreUsuario); 
            $consulta->bindParam("email",$email);
            $consulta->bindParam("contranya",$password);

            return $consulta->execute();
    }
    
    public function existeUsuario($nombreUsuario){
            $sql="SELECT nombreUsuario FROM usuarios WHERE nombreUsuario = :nombre";

            $consulta=$this->conexion->prepare($sql);
            $consulta->bindParam(
                "nombre",$nombreUsuario);
            $consulta->execute();

            return $consulta->fetch() !== false;
            }
            
    
}
?>