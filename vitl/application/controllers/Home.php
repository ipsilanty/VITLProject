<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Dragos
 * Date: 10/09/2018
 * Time: 18:10
 */
class Home extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('Names');
    }

    public function index() {

        //Load view file
        $this->load->view('home');
    }

    /**
     *
     * search: search for entries after input has met requirements
     *
     *
     */

    public function search() {

        $return_array = $this->Names->get_names($this->input->post('terms'), $this->input->post('dupes'));

        echo json_encode($return_array);
    }
}