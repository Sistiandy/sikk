<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Periode Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Periode_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('periode.periode_id', $params['id']);
        }
        
        if(isset($params['periode_date']))
        {
            $this->db->where('periode_date', $params['periode_date']);
        }

        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('periode_last_update', 'desc');
        }

        $this->db->select('periode.periode_id, periode_date, periode_total_budget, periode_description,
            periode_input_date, periode_last_update');
        $this->db->select('user_user_id, user_name');
        $this->db->join('user', 'user.user_id = periode.user_user_id', 'left');
        $res = $this->db->get('periode');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    // Add and update to database
    function add($data = array()) {
        
         if(isset($data['periode_id'])) {
            $this->db->set('periode_id', $data['periode_id']);
        }
        
         if(isset($data['periode_date'])) {
            $this->db->set('periode_date', $data['periode_date']);
        }
        
         if(isset($data['periode_total_budget'])) {
            $this->db->set('periode_total_budget', $data['periode_total_budget']);
        }

        if (isset($data['increase_budget'])) {
            $this->db->set('periode_total_budget', 'periode_total_budget +' . $data['increase_budget'], FALSE);
        }
        
         if(isset($data['periode_description'])) {
            $this->db->set('periode_description', $data['periode_description']);
        }
        
         if(isset($data['periode_input_date'])) {
            $this->db->set('periode_input_date', $data['periode_input_date']);
        }
        
         if(isset($data['periode_last_update'])) {
            $this->db->set('periode_last_update', $data['periode_last_update']);
        }
        
         if(isset($data['user_id'])) {
            $this->db->set('user_user_id', $data['user_id']);
        }
        
        if (isset($data['periode_id'])) {
            $this->db->where('periode_id', $data['periode_id']);
            $this->db->update('periode');
            $id = $data['periode_id'];
        } else {
            $this->db->insert('periode');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    // Delete to database
    function delete($id) {
        $this->db->where('periode_id', $id);
        $this->db->delete('periode');
    }
    
}
