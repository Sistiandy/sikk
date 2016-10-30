<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Input_transaction Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Input_transaction_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('input_transaction.transaction_id', $params['id']);
        }
        
        if(isset($params['periode_id']))
        {
            $this->db->where('periode_periode_id', $params['periode_id']);
        }
        
        if(isset($params['student_id']))
        {
            $this->db->where('student_student_id', $params['student_id']);
        }
        
        if(isset($params['status']))
        {
            $this->db->where('input_transaction_value IS NOT NULL');
        }
        
        if(isset($params['status_null']))
        {
            $this->db->where('input_transaction_value IS NULL');
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
            $this->db->order_by($params['order_by'], 'asc');
        }
        else
        {
            $this->db->order_by('transaction_last_update', 'desc');
        }

        $this->db->select('input_transaction.transaction_id, input_transaction_value,
            transaction_input_date, transaction_last_update, student_id');
        $this->db->select('input_transaction.user_user_id, user_name');
        $this->db->select('periode_periode_id, periode_date, periode_description');
        $this->db->select('student_student_id, student_name, student_nip');
        
        $this->db->join('user', 'user.user_id = input_transaction.user_user_id', 'left');
        $this->db->join('periode', 'periode.periode_id = input_transaction.periode_periode_id', 'left');
        $this->db->join('student', 'student.student_id = input_transaction.student_student_id', 'left');
        $res = $this->db->get('input_transaction');

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
        
         if(isset($data['transaction_id'])) {
            $this->db->set('transaction_id', $data['transaction_id']);
        }
        
         if(isset($data['periode_id'])) {
            $this->db->set('periode_periode_id', $data['periode_id']);
        }
        
         if(isset($data['input_transaction_value'])) {
            $this->db->set('input_transaction_value', $data['input_transaction_value']);
        }
        
         if(isset($data['student_id'])) {
            $this->db->set('student_student_id', $data['student_id']);
        }
        
         if(isset($data['transaction_input_date'])) {
            $this->db->set('transaction_input_date', $data['transaction_input_date']);
        }
        
         if(isset($data['transaction_last_update'])) {
            $this->db->set('transaction_last_update', $data['transaction_last_update']);
        }
        
         if(isset($data['user_id'])) {
            $this->db->set('user_user_id', $data['user_id']);
        }
        
        if (isset($data['transaction_id'])) {
            $this->db->where('transaction_id', $data['transaction_id']);
            $this->db->update('input_transaction');
            $id = $data['transaction_id'];
        } else {
            $this->db->insert('input_transaction');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    // Delete to database
    function delete($id) {
        $this->db->where('transaction_id', $id);
        $this->db->delete('input_transaction');
    }
    
}
