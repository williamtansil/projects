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

    function f_planes_data($plane_callsign) {
    	if($plane_callsign != null) {
    		$this->db->where("flight_callsign", $plane_callsign);	
    	}
    	return $this->db->get("plane")->result_array();
    }

    function w_plane_data($plane_callsign){
        if (!isset($_POST['command_param'])) {
            $data = array(
                'flight_callsign'=>$this->input->post('callsign'),
                'altitude'=>$this->input->post('alt'),
                'heading'=>$this->input->post('hdg'),
                'x'=>$this->input->post('x'),
                'y'=>$this->input->post('y'),
                'pxps_x'=>$this->input->post('pxps_x'),
                'pxps_y'=>$this->input->post('pxps_y'),
            ); 
        } else {
            //[0]=command target
            //[1]=command spd change
            $command_param=explode(',',$_POST['command_param']);            
            if(is_array($command_param)){
                $data = array(
                    $command_param[0]=>$this->input->post('command_target'),
                    $command_param[1]=>$this->input->post('change_spd')
                );
            }
        }
        print_r($data);
    	$this->db->where("flight_callsign", $plane_callsign);
    	$this->db->update('plane', $data);
    }

    function r_command_data($command=null) {
    	$this->db->where('command_callsign', $command);
    	return $this->db->get('command')->row_array();
    }

    function f_collision_data(){
        //get collission plane
        $this->db->select('COUNT(*) as count,x, y');
        $this->db->group_by('altitude, x, y');
        $data = $this->db->get('plane')->result_array();
        echo $this->db->last_query();
        echo "<pre>";
        print_r($data);
        die();
        //check is there collision
        if(count($data) > 0) {
            $this->db->group_by('altitude');
            $this->db->delete('plane');
        } else {
            return -1;
        }
    }
}