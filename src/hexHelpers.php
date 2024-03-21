<?php

namespace Assembler;

trait FileHelper {

    public function clearFile(string $file): void
    {
        $file = fopen($file, 'w');  // 'w' abre el archivo para escritura (write), sobrescribe el contenido existente

        if ($file) {
            fwrite($file, "");  // Escribe una cadena vacía para limpiar el archivo
            fclose($file);
            echo "Archivo limpiado.\n";
        } else {
            echo "Ocurrió un error al intentar limpiar el archivo\n";
        }
    }

    public function putLineOn($line, $file = 'errores.err'): void
    {
        $file = fopen($file, 'a');

        if($file) {
            fwrite($file, $line);
            fclose($file);
        }
        else {
            echo "Ocurrio un error\n";
        }
    }

}

trait HexHelpers 
{

    protected function getIntFrom(string $num): int
    {        
        $aux = $this->canGetHex($num) 
        ? hexdec($num) 
        : $num;
        return intval($aux);
    }

    protected function canGetHex(string $num): string|bool
    {
        return strpos($num, 'H') !== false;
    }

    function adjustHexLength($hex, $length) {
        // Agregar ceros a la izquierda hasta alcanzar la longitud deseada
        $adjustedHex = str_pad($hex, $length, '0', STR_PAD_LEFT);
    
        return $adjustedHex;
    }

    function isHexOrDec($str, &$type = null) {
        if(preg_match('/^[0-9a-fA-F]+H$/', $str)) {
            $type = NUM::HEX;
            return true;
        }
        if(is_numeric($str)) {
            $type = NUM::INT;
            return true;
        }
        return false;
    }

    function subHexStr($str, $offset = 3) {
        $desphex = $this->adjustHexLength($str, $offset);
        $length = strlen($desphex);
        return substr($desphex, $length - $offset);
    }

    function getHexFromString(string $str): string
    {
        $out = '';
        foreach(str_split($str) as $c)
        {
            $out.= dechex(ord($c));
        }
        return $out;
    }
}