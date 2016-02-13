<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Output_transaction_model Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Output_transaction_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('output_transaction_id', $params['id']);
        }
        
        if(isset($params['transaction_title']))
        {
            $this->db->where('transaction_title', $params['transaction_title']);
        }
        
        if(isset($params['transaction_date']))
        {
            $this->db->like('transaction_date', $params['transaction_date']);
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
            $this->db->order_by('transaction_last_update', 'desc');
        }

        $this->db->select('output_transaction_id, transaction_title, transaction_date, transaction_description,
            transaction_budget, transaction_input_date, transaction_last_update');
        $this->db->select('user_user_id, user_name');
        $this->db->join('user', 'user.user_id = output_transaction.user_user_id', 'left');
        $res = $this->db->get('output_transaction');

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

       if(isset($data['output_transaction_id'])) {
        $this->db->set('output_transaction_id', $data['output_transaction_id']);
    }

    if(isset($data['transaction_date'])) {
        $this->db->set('transaction_date', $data['transaction_date']);
    }

    if(isset($data['transaction_title'])) {
        $this->db->set('transaction_title', $data['transaction_title']);
    }

    if(isset($data['transaction_budget'])) {
        $this->db->set('transaction_budget', $data['transaction_budget']);
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

    if (isset($data['output_transaction'])) {
        $this->db->where('output_transaction_id', $data['output_transaction_id']);
        $this->db->update('output_transaction');
        $id = $data['output_transaction_id'];
    } else {
        $this->db->insert('output_transaction');
        $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

    // Delete to database
function delete($id) {
    $this->db->where('output_transaction_id', $id);
    $this->db->update('output_transaction');
}

}
