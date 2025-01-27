<?php

namespace Faker\Provider;

class Image extends Base
{
    public const BASE_URL = 'https://loremflickr.com';

    /**
     * Generate the URL that will return a random image.
     */
    public static function imageUrl(
        $width = 640,
        $height = 480,
        $category = null,
        $randomize = true
    ) {
        $url = self::BASE_URL . "/{$width}/{$height}";
    
        if ($category) {
            $url .= '/' . urlencode($category);
        }
    
        // Agregar un parámetro único para evitar imágenes repetidas
        if ($randomize) {
            $url .= '?random=' . uniqid();
        }
    
        return $url;
    }
    

    /**
     * Download a remote random image to disk and return its location.
     */
    public static function image(
        $dir = null,
        $width = 640,
        $height = 480,
        $category = null,
        $fullPath = true,
        $randomize = true
    ) {
        $dir = $dir ?? sys_get_temp_dir();
    
        // Crear el directorio si no existe
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    
        if (!is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
        }
    
        // Generar URL de la imagen (ahora será única)
        $url = static::imageUrl($width, $height, $category, $randomize);
    
        // Generar nombre único para el archivo
        $filename = sprintf('%s.jpg', md5(uniqid(mt_rand(), true)));
        $filepath = $dir . DIRECTORY_SEPARATOR . $filename;
    
        // Descargar la imagen
        $success = @file_put_contents($filepath, @file_get_contents($url));
    
        if ($success === false) {
            throw new \RuntimeException("Failed to download the image from {$url}");
        }
    
        return $fullPath ? $filepath : $filename;
    }
    
}
