<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 5/11/2017
 * Time: 5:51 PM
 */
class ATC extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index() {
        $this->load->view("atc/homepage");
    }
    public function start_simulation() {
        //$this->load->view("atc/create_simulation_form");
        $this->load->view("atc/radar_page");
    }
}