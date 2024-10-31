<?php 
namespace App\Services\Cryptography;


class ColumnarTransposition
{
    public function encrypt($text, $key)
    {
        // Quitar los espacios del texto (opcional)
        $text = str_replace(' ', '', $text);

        // Crear una matriz basada en la longitud de la clave
        $columns = strlen($key);
        $rows = ceil(strlen($text) / $columns);

        // Llenar la matriz por filas
        $matrix = [];
        $index = 0;
        for ($i = 0; $i < $rows; $i++) {
            $row = [];
            for ($j = 0; $j < $columns; $j++) {
                // Si hemos alcanzado el final del texto, rellenamos con un carácter de relleno (ej: 'X')
                $row[] = isset($text[$index]) ? $text[$index] : 'X';
                $index++;
            }
            $matrix[] = $row;
        }

        // Crear el array de la clave con los índices originales
        $keyOrder = str_split($key);
        $numericKeyOrder = array_map('intval', $keyOrder); // Convertir a números
        $columnOrder = range(0, $columns - 1);
        array_multisort($numericKeyOrder, SORT_ASC, $columnOrder);

        // Leer la matriz por columnas en el orden de la clave
        $cipherText = '';
        foreach ($columnOrder as $colIndex) {
            for ($i = 0; $i < $rows; $i++) {
                $cipherText .= $matrix[$i][$colIndex];
            }
        }

        return $cipherText;
    }

    public function decrypt($cipherText, $key)
    {
        // Calcular las dimensiones de la matriz
        $columns = strlen($key);
        $rows = ceil(strlen($cipherText) / $columns);

        // Crear el array de la clave con los índices originales
        $keyOrder = str_split($key);
        $numericKeyOrder = array_map('intval', $keyOrder); // Convertir a números
        $columnOrder = range(0, $columns - 1);
        array_multisort($numericKeyOrder, SORT_ASC, $columnOrder);

        // Crear la matriz vacía
        $matrix = array_fill(0, $rows, array_fill(0, $columns, ''));

        // Llenar la matriz por columnas en el orden de la clave
        $index = 0;
        foreach ($columnOrder as $colIndex) {
            for ($i = 0; $i < $rows; $i++) {
                if ($index < strlen($cipherText)) {
                    $matrix[$i][$colIndex] = $cipherText[$index];
                    $index++;
                }
            }
        }

        // Leer la matriz por filas para obtener el texto plano
        $plainText = '';
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                if ($matrix[$i][$j] !== 'X') { // Omitir el carácter de relleno
                    $plainText .= $matrix[$i][$j];
                }
            }
        }

        return $plainText;
    }
}
