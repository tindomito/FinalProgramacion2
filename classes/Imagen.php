<?php
class Imagen
{   
    /**
     * Método que obtiene los datos de la imágen y los concatena para ubicarlos en un directorio del servidor.
     */
    public static function subirImagen($directorio, $datosArchivo): string
    {
        $nombreOriginal = (explode(".", $datosArchivo['name']));
        $extension = end($nombreOriginal);
        $nombreNuevo = time() . ".$extension";

        $archivoSubido = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$nombreNuevo");

        if(!$archivoSubido){
            throw new Exception("No se pudo subir la foto");
        }else{
            return $nombreNuevo;
        }
    }
    /**
     * Método que borra un archivo de imágen que se ubique en una ruta determinada
     */
    public static function borrarImagen($archivo): bool
    {
        if(file_exists($archivo)){
            $fileDelete = unlink($archivo);

            if(!$fileDelete){
                throw new Exception("No se pudo eliminar la imagen");
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
?>