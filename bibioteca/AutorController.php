<?php
class AutorController extends Controller{
   
   private $pdo;

    public function __construct(SessionManager $session) {
        parent::__construct($session);
        $this->pdo = Database::getConnection();
    }
    public function verAutores()
    {

        $modeloAutor = new Autor();
        
        // aqui vas a almacenar los autores que recibes
        $autores = $modeloAutor->verAutores();

        $params=[
        'autores'=> $autores,
        
        ];

        require __DIR__ . '/../templates/verAutores.php';
    }


    

    
}
