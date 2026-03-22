<?php

class Autor {
      private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function verAutores()  {
    
        $sql="SELECT 
            a.id, 
            a.nombre, 
            a.apellidos, 
            -- Se puede tambien con a.*
            COUNT(l.id) AS totalLibros 
        FROM autores a 		
        JOIN libros l ON a.id= l.idAutor
        GROUP BY a.id, a.nombre, a.apellidos;";
    




        $consulta=$this->conexion->prepare($sql);

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);


        // $sql = "SELECT a.id, a.titulo, a.descripcion, a.precio, a.fecha_publicacion, u.nombre AS nombre_usuario
        //          FROM articulos AS a
        //          JOIN usuarios AS u
        //          WHERE usuario_id = u.id";
        // $stmt = $this->conexion->prepare($sql);
        // $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>