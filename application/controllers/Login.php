<?php
/**
 *@author uyc.tic@gmail.com
 * @author JEAN DE DIEU
 */
class Login extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index($message = NULL) {
        
        $data['sms'] = $message;
        $this->load->view('Login_View', $data); 
        
    }

	public function do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

               
        $user = $this->Model->readOne('admin_user', ['username'=> $username,'statut'=>1]);
        if (!empty($user)) {
            if ($user['password'] == md5($password) ) 
            {
                
                $session = array(
                    'userid' => $user['id_admin_user'],
                    'username' => $user['username']
                );

                $this->session->set_userdata($session);

                redirect(base_url('rapport/Dashboard'));
                
            } else
                $message = "<div class='alert alert-danger text-center'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
            
        } else
            $message = "<div class='alert alert-danger text-center'> L'utilisateur n'existe pas dans notre système informatique !</div>";

        $this->index($message);
    }


    public function do_logout() {
        $session = array(
            'userid' => NULL,
            'username' => NULL
        );

        $this->session->set_userdata($session);
        redirect(base_url());
    }
}