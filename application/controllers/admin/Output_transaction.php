<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Output_transaction controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Output_transaction extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Output_transaction_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Input_transaction view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['output'] = $this->Output_transaction_model->get(array('status' => TRUE));

        $data['title'] = 'Transaksi Pengeluaran';
        $data['main'] = 'admin/output_transaction/output_transaction_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Output_transaction_model->get(array('id' => $id)) == NULL) {
            redirect('admin/output_transaction');
        }
        $data['output'] = $this->Output_transaction_model->get(array('id' => $id));
        $data['title'] = 'Detail Transaksi Pengeluaran';
        $data['main'] = 'admin/output_transaction/output_transaction_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Output_transaction and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('transaction_title', 'Transaksi', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('output_transaction_id')) {
                $params['output_transaction_id'] = $this->input->post('output_transaction_id');
            } else {
                $params['transaction_input_date'] = date('Y-m-d H:i:s');
            }

            $params['user_id'] = $this->session->userdata('user_id');
            $params['transaction_title'] = $this->input->post('transaction_title');
            $params['transaction_budget'] = $this->input->post('transaction_budget');
            $params['transaction_last_update'] = date('Y-m-d H:i:s');
            $params['transaction_date'] = $this->input->post('transaction_date');
            $params['transaction_description'] = $this->input->post('transaction_description');
            $status = $this->Output_transaction_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Output_transaction',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:null;Date:' . $params['transaction_date']
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Transaksi Kas berhasil');
            redirect('admin/output_transaction');
        } else {
            if ($this->input->post('output_transaction_id')) {
                redirect('admin/output_transaction/edit/' . $this->input->post('output_transaction_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['output'] = $this->Output_transaction_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' Transaksi Pengeluaran';
            $data['main'] = 'admin/output_transaction/output_transaction_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Output_transaction
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Output_transaction_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Output_transaction',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Date:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus Transaksi Pengeluaran berhasil');
            redirect('admin/output_transaction');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/output_transaction/edit/' . $id);
        }
    }

}

/* End of file output_transaction.php */
/* Location: ./application/controllers/admin/output_transaction.php */
