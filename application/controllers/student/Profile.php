<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_student') == NULL) {
            header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Student_model');
        $this->load->model('Activity_log_model');
        $this->load->helper(array('form', 'url'));
    }

    // User_customer view in list
    public function index($offset = NULL) {
        $id = $this->session->userdata('student_id');
        if ($this->Student_model->get(array('id' => $id)) == NULL) {
            redirect('student/user');
        }
        $data['student'] = $this->Student_model->get(array('id' => $id));
        $data['title'] = 'Detail Profil';
        $data['main'] = 'student/profile/profile_detail';
        $this->load->view('student/layout', $data);
    }

    // Add User_customer and Update
    public function edit($id = NULL) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('student_name', 'Nama Lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_place_birth', 'Tempat Lahir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_birth_date', 'Tanggal Lahir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_phone', 'No TLP', 'trim|required|xss_clean');        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            $nip = $this->input->post('student_nip');
            $params['student_id'] = $this->input->post('student_id');
            $params['student_last_update'] = date('Y-m-d H:i:s');
            $params['student_full_name'] = stripslashes($this->input->post('student_full_name'));
            $params['student_sex'] = $this->input->post('student_sex');
            $params['student_birth_place'] = $this->input->post('student_birth_place');
            $params['student_birth_date'] = $this->input->post('student_birth_date');
            $params['student_school'] = $this->input->post('student_school');
            $params['student_phone'] = $this->input->post('student_phone');
            $params['student_address'] = $this->input->post('student_address');
            $params['student_mentor'] = $this->input->post('student_mentor');
            $params['student_entry_date'] = $this->input->post('student_entry_date');
            $params['student_division'] = $this->input->post('student_division');
            $status = $this->Student_model->add($params);

            if (!empty($_FILES['student_image']['name'])) {
                if ($this->input->post('student_id')) {
                    $createdate = $this->input->post('student_input_date');
                } else {
                    $createdate = date('Y-m-d H:i');
                }
                $paramsupdate['student_image'] = $this->do_upload($name = 'student_image', $createdate, $nip);
            }
            $paramsupdate['student_id'] = $status;
            $this->Student_model->add($paramsupdate);

            $this->session->set_flashdata('success', $data['operation'] . ' Profil Berhasil');
            redirect('student/profile');
        } else {

            // Edit mode
            $data['student'] = $this->Student_model->get(array('id' => $this->session->userdata('student_id')));
            $data['button'] = 'Ubah';
            $data['title'] = $data['operation'] . ' Profil';
            $data['main'] = 'student/profile/profile_edit';
            $this->load->view('student/layout', $data);
        }
    }

    // Setting Upload File Requied
    function do_upload($name, $createdate, $nip) {
        $this->load->library('upload');
        $config['upload_path'] = FCPATH . 'uploads/';

        $paramsupload = array('date' => $createdate);
        list($date, $time) = explode(' ', $paramsupload['date']);
        list($year, $month, $day) = explode('-', $date);
        $config['upload_path'] = FCPATH . 'uploads/student_photo/' . $year . '/' . $month . '/' . $day . '/';

        /* create directory if not exist */
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '32000';
        $config['file_name'] = $nip;
                $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
//            echo $config['upload_path'];
            $this->session->set_flashdata('failed', $this->upload->display_errors(''));
            redirect(uri_string());
        }

        $upload_data = $this->upload->data();

        return $upload_data['file_name'];
    }

    function cpw($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|min_length[6]|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $id = $this->input->post('student_id');
            $params['password'] = sha1($this->input->post('password'));
            $status = $this->Student_model->change_password($id, $params);

            $this->session->set_flashdata('success', 'Ubah Password Berhasil');
            redirect('student/profile');
        } else {
            if ($this->Student_model->get(array('id' => $id)) == NULL) {
                redirect('student/profile');
            }
            $data['student'] = $this->Student_model->get(array('id' => $id));
            $data['title'] = 'Ubah Password';
            $data['main'] = 'student/profile/change_pass';
            $this->load->view('student/layout', $data);
        }
    }

}

/* End of file user.php */
/* Location: ./application/controllers/ccp/user.php */
