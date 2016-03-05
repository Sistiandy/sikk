<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Student Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('student.student_id', $params['id']);
        }
        
        if(isset($params['nip']))
        {
            $this->db->where('student_nip', $params['nip']);
        }
        
        if(isset($params['student_name']))
        {
            $this->db->like('student_name', $params['student_name']);
        }

        if(isset($params['deleted']))
        {
            $this->db->where('student_is_deleted', $params['deleted']);
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
            $this->db->order_by('student_last_update', 'desc');
        }

        $this->db->select('student.student_id, student_name, student_nip, student_name, student_place_birth, student_password,
            student_birth_date, student_phone, student_email, student_address, student_is_deleted, student_budget,
            student_input_date, student_last_update');
        $this->db->select('user_user_id, user_name');
        $this->db->join('user', 'user.user_id = student.user_user_id', 'left');
        $res = $this->db->get('student');

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
        
         if(isset($data['student_id'])) {
            $this->db->set('student_id', $data['student_id']);
        }
        
         if(isset($data['student_nip'])) {
            $this->db->set('student_nip', $data['student_nip']);
        }
        
         if(isset($data['student_name'])) {
            $this->db->set('student_name', $data['student_name']);
        }
        
         if(isset($data['student_password'])) {
            $this->db->set('student_password', $data['student_password']);
        }
        
         if(isset($data['student_phone'])) {
            $this->db->set('student_phone', $data['student_phone']);
        }
        
         if(isset($data['student_email'])) {
            $this->db->set('student_email', $data['student_email']);
        }
        
         if(isset($data['student_address'])) {
            $this->db->set('student_address', $data['student_address']);
        }

         if(isset($data['student_place_birth'])) {
            $this->db->set('student_place_birth', $data['student_place_birth']);
        }

         if(isset($data['student_birth_date'])) {
            $this->db->set('student_birth_date', $data['student_birth_date']);
        }
        
         if(isset($data['student_budget'])) {
            $this->db->set('student_budget', $data['student_budget']);
        }

        if (isset($data['increase_budget'])) {
            $this->db->set('student_budget', 'student_budget +' . $data['increase_budget'], FALSE);
        }
        
         if(isset($data['student_is_deleted'])) {
            $this->db->set('student_is_deleted', $data['student_is_deleted']);
        }
        
         if(isset($data['student_input_date'])) {
            $this->db->set('student_input_date', $data['student_input_date']);
        }
        
         if(isset($data['student_last_update'])) {
            $this->db->set('student_last_update', $data['student_last_update']);
        }
        
         if(isset($data['user_id'])) {
            $this->db->set('user_user_id', $data['user_id']);
        }
        
        if (isset($data['student_id'])) {
            $this->db->where('student_id', $data['student_id']);
            $this->db->update('student');
            $id = $data['student_id'];
        } else {
            $this->db->insert('student');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    // Delete to database
    function delete($id) {
        $this->db->where('student_id', $id);
        $this->db->set('student_is_deleted', 1);
        $this->db->update('student');
    }
    
}
