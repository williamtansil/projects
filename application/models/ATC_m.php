<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 5/14/2017
 * Time: 11:23 AM
 */
class ATC_m extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    function f_plane_data() {
    	return $this->db->get("plane")->result_array();
    }
}