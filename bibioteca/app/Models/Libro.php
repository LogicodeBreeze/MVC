<?php

class Libro {
      private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function verLibro() {

        $sql="SELECT l.id,l.titulo,l.descripcion,l.anio,a.nombre AS autor,e.nombre AS editorial
            FROM libros l 
            JOIN autores a
            ON l.idAutor=a.id
            JOIN editoriales e 
            ON l.idEditorial= e.id";

        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
                }
    
}
?>