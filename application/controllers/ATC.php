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

    public function get_planes_data($plane_callsign=null) {
        $plane = $this->atc_m->f_planes_data($plane_callsign);
         echo json_encode($plane);
    }

    public function put_plane_data($plane_callsign=null) {
        echo "flight callsign";
        echo $plane_callsign;
        $this->atc_m->w_plane_data($plane_callsign);
        echo json_encode($this->input->post());
    }

    public function get_command_data($command=null) {
        $result = $this->atc_m->r_command_data($command);
        echo json_encode($result);
    }

    public function check_now_collision() {
        $result = $this->atc_m->f_collision_data();
        return json_encode($result);
    }
}