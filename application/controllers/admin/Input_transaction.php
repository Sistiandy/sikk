<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Input_transaction controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Input_transaction extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Input_transaction_model', 'Periode_model', 'Student_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Input_transaction view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['input_transaction'] = $this->Input_transaction_model->get(array('limit' => 10, 'offset' => $offset, 'status' => TRUE));
        $config['base_url'] = site_url('admin/input_transaction/index');
        $config['total_rows'] = count($this->Input_transaction_model->get(array('status' => TRUE)));
        $this->pagination->initialize($config);

        $data['title'] = 'Input_transaction';
        $data['main'] = 'admin/input_transaction/input_transaction_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Input_transaction_model->get(array('id' => $id)) == NULL) {
            redirect('admin/input_transaction');
        }
        $data['input_transaction'] = $this->Input_transaction_model->get(array('id' => $id));
        $data['title'] = 'Detail Input_transaction';
        $data['main'] = 'admin/input_transaction/input_transaction_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Input_transaction and Update
    public function add($id = NULL) {
        $this->load->model('Setting_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('periode_id', 'Periode', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('transaction_id')) {
                $params['transaction_id'] = $this->input->post('transaction_id');
            } else {
                $params['transaction_input_date'] = date('Y-m-d H:i:s');
            }
            $cash = $this->Setting_model->get(array('id' => CLASS_CASH));
            $student = $_POST['student_id'];
            $cpt = count($_POST['student_id']);
            for ($i = 0; $i < $cpt; $i++) {
                $params['increase_budget'] = $cash['setting_value'];
                $params['user_id'] = $this->session->userdata('user_id');
                $params['transaction_last_update'] = date('Y-m-d H:i:s');
                $params['transaction_date'] = $this->input->post('transaction_date');
                $params['transaction_description'] = $this->input->post('transaction_description');
                $params['periode_id'] = $this->input->post('periode_id');
                $params['student_id'] = $student[$i];
                $status = $this->Input_transaction_model->add($params);
                if (!$this->input->post('transaction_id')) {
                    $this->Student_model->add($params);
                    $this->Periode_model->add($params);
                }


                // activity log
                $this->Activity_log_model->add(
                        array(
                            'log_date' => date('Y-m-d H:i:s'),
                            'user_id' => $this->session->userdata('user_id'),
                            'log_module' => 'Input_transaction',
                            'log_action' => $data['operation'],
                            'log_info' => 'ID:null;Date:' . $params['transaction_date']
                        )
                );
            }

            $this->session->set_flashdata('success', $data['operation'] . ' Transaksi Kas berhasil');
            redirect('admin/input_transaction');
        } else {
            if ($this->input->post('transaction_id')) {
                redirect('admin/input_transaction/edit/' . $this->input->post('transaction_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['input_transaction'] = $this->Input_transaction_model->get(array('id' => $id));
            }
            $data['ngapp'] = 'ng-app="inputApp"';
            $data['periode'] = $this->Periode_model->get();
            $data['student'] = $this->Student_model->get();
            $data['title'] = $data['operation'] . ' Transaksi Kas';
            $data['main'] = 'admin/input_transaction/input_transaction_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Input_transaction
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Input_transaction_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Input_transaction',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Date:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus Transaksi Kas berhasil');
            redirect('admin/input_transaction');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/input_transaction/edit/' . $id);
        }
    }

}

/* End of file input_transaction.php */
/* Location: ./application/controllers/admin/input_transaction.php */
