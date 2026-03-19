<?php
class LibroController extends Controller{
   
   
    public function verLibros()
    {

        $modeloLibros=new Libro();

        $libros=$modeloLibros->verLibro();
        $params=[
            'libros'=>$libros
        ];

        require __DIR__ . '/../templates/verLibros.php';
    }


    

    
}
