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
        $data['title'] = 'Dashboard';
        $data['main'] = 'student/dashboard/dashboard';
        $this->load->view('student/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
