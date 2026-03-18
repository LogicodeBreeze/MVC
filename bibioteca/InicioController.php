<?php
class InicioController extends Controller{
   
   
    public function inicio()
    {

        $params = array(
            'titulo'  => 'Bienvenido a la Biblioteca Virtual'
        );
        

        require __DIR__ . '/../templates/inicio.php';
    }

    

    

    

    

    
}
