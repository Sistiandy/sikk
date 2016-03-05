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
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    // Dashboard View
    public function index()
    {
        $this->load->model('Student_model');
        $this->load->model('Input_transaction_model');
        $this->load->model('Output_transaction_model');
        $this->load->model('Periode_model');
        $data['student'] = count($this->Student_model->get(array('deleted' => FALSE)));
        $data['input'] = count($this->Input_transaction_model->get());
        $data['output'] = count($this->Output_transaction_model->get());
        $data['periode'] = count($this->Periode_model->get());
        $data['title'] = 'Dashboard';
        $data['main'] = 'admin/dashboard/dashboard';
        $this->load->view('admin/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
