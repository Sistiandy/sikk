<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Periode controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Periode extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Periode_model', 'Input_transaction_model','Activity_log_model'));
        $this->load->library('upload');
    }

    // Periode view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['periode'] = $this->Periode_model->get(array('limit' => 10, 'offset' => $offset, 'status' => TRUE));
        $config['base_url'] = site_url('admin/periode/index');
        $config['total_rows'] = count($this->Periode_model->get(array('status' => TRUE)));
        $this->pagination->initialize($config);

        $data['title'] = 'Periode';
        $data['main'] = 'admin/periode/periode_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Periode_model->get(array('id' => $id)) == NULL) {
            redirect('admin/periode');
        }
        $data['periode'] = $this->Periode_model->get(array('id' => $id));
        $data['transaction'] = $this->Input_transaction_model->get(array('periode_id' => $id));
        $data['title'] = 'Detail Periode';
        $data['main'] = 'admin/periode/periode_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Periode and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('periode_date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('periode_id')) {
                $params['periode_id'] = $this->input->post('periode_id');
            } else {
                $params['periode_input_date'] = date('Y-m-d H:i:s');
            }

            $params['user_id'] = $this->session->userdata('user_id');
            $params['periode_last_update'] = date('Y-m-d H:i:s');
            $params['periode_date'] = $this->input->post('periode_date');
            $params['periode_description'] = $this->input->post('periode_description');
            $status = $this->Periode_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Periode',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:null;Date:' . $params['periode_date']
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Periode berhasil');
            redirect('admin/periode');
        } else {
            if ($this->input->post('periode_id')) {
                redirect('admin/periode/edit/' . $this->input->post('periode_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['periode'] = $this->Periode_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' Periode';
            $data['main'] = 'admin/periode/periode_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Periode
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Periode_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Periode',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Date:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus Periode berhasil');
            redirect('admin/periode');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/periode/edit/' . $id);
        }
    }

}

/* End of file periode.php */
/* Location: ./application/controllers/admin/periode.php */
