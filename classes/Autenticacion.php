<?php
class Autenticacion
{
    public static function log_in(string $usuario, string $password): mixed
    {
        $datosUsuario = Usuario::usuario_x_username($usuario);

        if ($datosUsuario) {
            if (password_verify($password, $datosUsuario->getClave())) {
                $datosLogin['usuario'] = $datosUsuario->getUsuario();
                $datosLogin['nombre'] = $datosUsuario->getNombre();
                $datosLogin['id_usuario'] = $datosUsuario->getIdUsuario();
                $_SESSION['loggedIn'] = $datosLogin;

                return TRUE;
            } else {
                Alerta::add_alerta('danger', "La clave ingresada no es correcta.");
                return FALSE;
            }
        } else {
            Alerta::add_alerta("warning", "El usuario ingresado no se encontró en nuestra base de datos.");
            return NULL;
        }
    }

    public static function log_out()
    {
        if (isset($_SESSION['loggedIn'])) {
            unset($_SESSION['loggedIn']);
        }
    }

    public static function verify(): bool
    {
        if (isset($_SESSION['loggedIn'])) {
            return TRUE;
        } else {
            Alerta::add_alerta("danger", "Debe iniciar sesión para continuar.");
            header("location: index.php?sec=login");
            exit;
        }
    }
}
?>
