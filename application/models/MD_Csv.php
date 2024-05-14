<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Csv extends CI_Model {
    public function removePercentage($value) {
        return str_replace('%', '', $value);
    }
    public function is_valid_date($date_str, $format = 'd/m/Y') {
        $d = DateTime::createFromFormat($format, $date_str);
        return $d && $d->format($format) === $date_str;
    }
    public function is_positive($amount) {
        return $amount > 0;
    }
    public function is_decimal($amount) {
        return is_float($amount) || is_numeric($amount) && strpos($amount, '.') !== false;
    }
    function sum_column_for_ref_devis($array, $column_index, $ref_devis, $ref_devis_column_index) {
        $sum = 0;
        foreach ($array as $row) {
            if (isset($row[$ref_devis_column_index]) && $row[$ref_devis_column_index] === $ref_devis) {
                if (isset($row[$column_index]) && is_numeric($row[$column_index])) {
                    $sum += (float) $row[$column_index];
                }
            }
        }
        return $sum;
    }
}
?>