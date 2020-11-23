<?php

/**
 * Фкнкция для отладки
 *
 * @param array $array
 * @return void
 */
function debug($array)
{
    echo '<pre>';
    echo print_r($array);
    echo '</pre>';
}
/**
 * "Умная" обрезка строки до выбранного лимита без дробления слов
 *
 * @param string $source
 * @param int $limit
 * @return string
 */
function SmartCutting($source, $limit)
{

    $words_array = explode(' ', $source);

    $short = '';

    for ($i = 0; $i < count($words_array); $i++) {
        if (mb_strlen($short, 'utf-8') <= $limit) {
            $short .= $words_array[$i] . ' ';
        }
    }

    $short = trim($short);

    if (mb_strlen($short, 'utf-8') <= $limit - 10) {
        $return = $source;
    } else {
        $return = $short.' ...';
    }

    return $return;
}
