<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Api controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $res = array('message' => 'Nothing here');

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

    public function getPeriodeTransaction($id = NULL) {
        $this->load->model('Input_transaction_model');
        $res = $this->Input_transaction_model->get(array('order_by' => 'student_nip' ,'periode_id' => $id));

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

    public function getStudentTransaction($id = NULL) {
        $this->load->model('Input_transaction_model');
        $res = $this->Input_transaction_model->get(array('limit_date' => TRUE,'student_id' => $id));

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

    public function getPeriode($id = NULL) {
        $this->load->model('Periode_model');
        $res = $this->Periode_model->get(array('id' => $id));

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

}
