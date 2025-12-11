<?php
class Alerta
{
    /**
     * Registra una alerta en el sistema, guardandola en la sesión.
     * @param string $tipo primary | secondary | success | danger | warning | info | light | dark
     * @param string $mensaje Mensaje que quiere que aparezca
     */
    public static function add_alerta(string $tipo, string $mensaje)
    {
        $_SESSION['alertas'][]=[
            'tipo' => $tipo,
            'mensaje' => $mensaje
        ];
    }

    /**
     * Vacía la lista de alertas
     */
    public static function clear_alertas()
    {
        $_SESSION['alertas'] = [];
    }

    /**
     * Imprime las alertas en la sesión
     */
    public static function print_alerta($alerta) :string
    {
        $html = "<div class='alert alert-{$alerta['tipo']} alert-dismissible fade show' role='alert'>";
        $html .= $alerta['mensaje'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Cerrar'></button>";
        $html .= "</div>";
        return $html;
    }

    /**
     * Obtiene las alertas
     */
    public static function get_alertas()
    {
        if (!empty($_SESSION['alertas'])){
            $alertasActuales = "";
            foreach ($_SESSION['alertas'] as $alerta) {
                $alertasActuales .= self::print_alerta($alerta);
            }
            self::clear_alertas();
            return $alertasActuales;
        }else{
            return null;
        }
    }

}
?>