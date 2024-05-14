<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Csv extends CI_Model {
    public function removePercentage($value) {
        return str_replace('%', '', $value);
    }
    public function is_valid_date($date_str) {
        $timestamp = strtotime($date_str);
        return $timestamp !== false && $timestamp !== -1;
    }    
}
?>