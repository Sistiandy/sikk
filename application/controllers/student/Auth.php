<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->helper('url');
    }

    function index() {
        redirect('student/auth/login');
    }

    function login() {
        if ($this->session->userdata('logged_student')) {
            redirect('student');
        }
        $this->form_validation->set_rules('nip', 'Nip', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            if ($this->input->post('location')) {
                $lokasi = $this->input->post('location');
            } else {
                $lokasi = NULL;
            }
            $this->process_login($lokasi);
        } else {
            $this->load->view('student/login');
        }
    }

    // Login Prosessing
    function process_login($lokasi = '') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nip', 'Nip', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $nip = $this->input->post('nip', TRUE);
            $password = sha1($this->input->post('password', TRUE));
            $student = $this->Student_model->get(array('nip' => $nip, 'password' => $password));
            

            if ($student > 0) {
                $this->session->set_userdata('logged_student', TRUE);
                $this->session->set_userdata('student_id', $student['student_id']);
                $this->session->set_userdata('student_nip', $student['student_nip']);
                $this->session->set_userdata('student_name', $student['student_name']);
                if ($lokasi != '') {
                    header("Location:" . htmlspecialchars($lokasi));
                } else {
                    redirect('student');
                }
            } else {
                if ($lokasi != '') {
                    $this->session->set_flashdata('failed', 'Sorry, username and password do not match');
                    header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($lokasi));
                } else {
                    $this->session->set_flashdata('failed', 'Sorry, username and password do not match');
                    redirect('student/auth/login');
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Sorry, username and password are not complete');
            redirect('student/auth/login');
        }
    }

    // Logout Processing
    function logout() {
        $this->session->unset_userdata('logged_student');
        $this->session->unset_userdata('student_id');
        $this->session->unset_userdata('student_name');
        $this->session->unset_userdata('student_nip');
        if ($this->input->post('location')) {
            $lokasi = $this->input->post('location');
        } else {
            $lokasi = NULL;
        }
        header("Location:" . $lokasi);
    }

}
