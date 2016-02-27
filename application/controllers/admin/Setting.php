<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Setting controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Setting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    public function index() {
        $this->load->model('Setting_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('class_name', 'Class Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_description', 'Class Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_cash', 'Class Cash', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            
            $param['class_name'] = $this->input->post('class_name');
            $param['class_description'] = $this->input->post('class_description');
            $param['class_cash'] = $this->input->post('class_cash');
            $this->Setting_model->save($param);
            $this->session->set_flashdata('success', ' Sunting pengaturan berhasil');
            redirect('admin/setting');
        } else {
            $data['title'] = 'Pengaturan';
            $data['class_name'] = $this->Setting_model->get(array('id' => CLASS_NAME));
            $data['class_description'] = $this->Setting_model->get(array('id' => CLASS_DESC));
            $data['class_cash'] = $this->Setting_model->get(array('id' => CLASS_CASH));
            $data['main'] = 'admin/setting/setting_list';
            $this->load->view('admin/layout', $data);
        }
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
