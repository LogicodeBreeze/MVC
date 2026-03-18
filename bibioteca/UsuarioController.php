<?php
class UsuarioController extends Controller{
    private $pdo;

    public function __construct(SessionManager $session) {
        parent::__construct($session);
        $this->pdo = Database::getConnection();
    }
   
    public function iniciarSesion()
    {

    $params=[];

        if($_POST){

            $nombreUsuario=  recoge("nombreUsuario");
            $contrasenya=  recoge("contrasenya");

            $usuarioModelo= new Usuario();
            $usuario=$usuarioModelo->iniciarSesion($nombreUsuario);

            //var_dump($usuario['fecha_registro']);

            // aqui comprobamos que el usuario de la BD realmente coincida con los datos pasados por el formulario
            if ($usuario['nombreUsuario'] == $nombreUsuario && $usuario['password'] == $contrasenya) {
                
                // aqui inicias sesion
                $this->session->login(
                    $usuario['id'],
                    $usuario['nombreUsuario'],
                    $usuario['nivel'],
                );

                // pasamos a la pantalla de ver libros
                header('Location:index.php?ctl=verLibros'); 
                exit;

            } else {
                // aqui vamos a mostrar un mensaje de error en caso de que no sean correctos los campos del usuario
                $params['mensaje']="no coincide los datos";
            }
    
        }
    

        require __DIR__ . '/../templates/formInicioSesion.php';
    }

    public function registro()
    {
        
        if($_POST){
            
            $nombreUsuario=  recoge("nombreUsuario");
            $email=recoge("email");
            $contrasenya=  recoge("contrasenya");

            $modeloUsuario=new Usuario();

            $encontrado = $modeloUsuario->existeUsuario($nombreUsuario);

            // si existe el nombre de usuario,no deja registrar
            if ($modeloUsuario->existeUsuario($nombreUsuario)) {
                 $params['mensaje'] = "El usuario ya existe";
            } else {

                $usuarioRegistro=$modeloUsuario->registro($nombreUsuario,$email,$contrasenya);

                if ($usuarioRegistro) {
                    $params['mensaje'] = "Usuario registrado";
                } else {
                    $params['mensaje'] = "Ha ocurrido un error al registrar el usuario";
                }

            }

            

        }
        

        require __DIR__ . '/../templates/formRegistro.php';
    }


    

    
}
