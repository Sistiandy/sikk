<?php

if (!defined('BASEPATH'))
    exit('No direct script are allowed');

/** 
* Setting Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Setting_model extends CI_Model {

    public function get($param = array()) {

        if (isset($param['id'])) {
            $this->db->where('setting_id', $param['id']);
        }
        
        if (isset($param['name'])) {
            $this->db->where('setting_name', $param['name']);
        }

        if (isset($param['id']) OR isset($param['name'])) {
            return $this->db->get('class_setting')->row_array();
        } else {
            return $this->db->get('class_setting')->result_array();
        }
    }

    public function get_value($params = array()) {
        $setting = $this->get($params);

        if (!empty($setting['setting_value']))
            return $setting['setting_value'];
        else
            return '';
    }

    public function save($param = array()) {
        if (isset($param['class_name'])) {
            $this->db->set('setting_value', $param['class_name']);
            $this->db->where('setting_id', 1);
            $this->db->update('class_setting');
        }
        if (isset($param['class_description'])) {
            $this->db->set('setting_value', $param['class_description']);
            $this->db->where('setting_id', 2);
            $this->db->update('class_setting');
        }
        if (isset($param['class_cash'])) {
            $this->db->set('setting_value', $param['class_cash']);
            $this->db->where('setting_id', 3);
            $this->db->update('class_setting');
        }

    }

}
