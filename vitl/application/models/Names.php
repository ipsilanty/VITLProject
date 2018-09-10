<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Dragos
 * Date: 10/09/2018
 * Time: 14:49
 */
class Names extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * get_names:
     *
     * @param string $name
     * @param bool $dup_out
     * @return string
     *
     */

    public function get_names($name, $dup_out) {

        $this->db->select("CONCAT( first_name,' ', last_name ) as name");
        $this->db->from('names');
        $this->db->where("CONCAT( first_name,' ', last_name ) LIKE  '%".$name."%'");
        //check if exclude duplicates has been requested
        if($dup_out == "true") {
            $this->db->group_by("name");
        }

        $this->db->order_by("last_name ASC, first_name ASC");
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}