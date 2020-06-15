<?php
/**
 * Create db.txt file, writes an array JSON format.
 *
 * @param $array
 * @param $file
 * @return bool
 */
function array_to_file(array $array, string $file): bool
{
    $string = json_encode($array);
    $bytes_writen = file_put_contents($file, $string);
    if ($bytes_writen === false) {
        return false;
    }
    return true;
}


/**
 * Get a data from file and convert to array.
 *
 * @param string $file_name
 * @return mixed
 */
function file_to_array(string $file_name)
{
    if (file_exists($file_name)) {
        $data = file_get_contents($file_name);
         return $array = json_decode($data, true) ?? [];
    } else {
        return false;
    }
}