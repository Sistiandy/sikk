<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Dashboard controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_student') == NULL) {
            header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    // Dashboard View
    public function index()
    {
        
        $this->load->model('Input_transaction_model');
        $this->load->model('Student_model');
        
        $id = $this->session->userdata('student_id');
        $data['student'] = $this->Student_model->get(array('id' => $id));
        $data['transaksi'] = $this->Input_transaction_model->get(array('limit_date' => TRUE, 'student_id' => $id));
        $data['tunggakan'] = $this->Input_transaction_model->get(array('limit_date' => TRUE, 'student_id' => $id, 'status_null' => TRUE));
        $data['lunas'] = $this->Input_transaction_model->get(array('limit_date' => TRUE, 'student_id' => $id, 'status' => TRUE));
        $data['title'] = 'Dashboard';
        $data['main'] = 'student/dashboard/dashboard';
        $this->load->view('student/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
