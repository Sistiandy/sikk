<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Student controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Student extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Student_model', 'Input_transaction_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Student view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $data['student'] = $this->Student_model->get(array('limit' => 10, 'offset' => $offset, 'status' => TRUE));
        $config['base_url'] = site_url('admin/student/index');
        $config['total_rows'] = count($this->Student_model->get(array('status' => TRUE)));
        $this->pagination->initialize($config);

        $data['title'] = 'Pelajar';
        $data['main'] = 'admin/student/student_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Student_model->get(array('id' => $id)) == NULL) {
            redirect('admin/student');
        }
        $data['student'] = $this->Student_model->get(array('id' => $id));
        $data['title'] = 'Detail Pelajar';
        $data['main'] = 'admin/student/student_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Student and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        if (!$this->input->post('student_id')) {
            $this->form_validation->set_rules('student_nip', 'NIP', 'trim|required|xss_clean|is_unique[student.student_nip]');
            $this->form_validation->set_rules('student_name', 'Name', 'trim|required|xss_clean|is_unique[student.student_name]');
            $this->form_validation->set_rules('student_password', 'Password', 'trim|required|min_length[6]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]|matches[student_password]');
        }
        $this->form_validation->set_rules('student_phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('student_id')) {
                $params['student_id'] = $this->input->post('student_id');
            } else {
                $params['student_input_date'] = date('Y-m-d H:i:s');
            }

            $params['user_id'] = $this->session->userdata('user_id');
            $params['student_last_update'] = date('Y-m-d H:i:s');
            $params['student_nip'] = $this->input->post('student_nip');
            $params['student_name'] = $this->input->post('student_name');
            $params['student_password'] = sha1($this->input->post('student_password'));
            $params['student_place_birth'] = $this->input->post('student_place_birth');
            $params['student_birth_date'] = $this->input->post('student_birth_date');
            $params['student_phone'] = $this->input->post('student_phone');
            $params['student_email'] = $this->input->post('student_email');
            $params['student_address'] = $this->input->post('student_address');
            $status = $this->Student_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Pelajar',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:null;Title:' . $params['student_name']
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Pelajar berhasil');
            redirect('admin/student');
        } else {
            if ($this->input->post('student_id')) {
                redirect('admin/student/edit/' . $this->input->post('student_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['student'] = $this->Student_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' Pelajar';
            $data['main'] = 'admin/student/student_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Student
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Student_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Pelajar',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Title:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus Pelajar berhasil');
            redirect('admin/student');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/student/edit/' . $id);
        }
    }

    public function get_student($id = NULL) {
        if ($id == NULL) {
            $res = $this->Student_model->get();
        } else {
            $student = $this->Input_transaction_model->get(array('periode_id' => $id));
            $students = $this->Student_model->get();
            
            $res_student = array();
            foreach ($student as $row) {
                $res_student[] = $row['student_student_id'];
            }

            foreach ($students as $key) {
                $res[] = array(
                    'student_id' => $key['student_id'],
                    'student_name' => $key['student_name'],
                    'ticked' => (in_array($key['partners_id'], $res_student)) ? true : false
                );
            }
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

}

/* End of file student.php */
/* Location: ./application/controllers/admin/student.php */
