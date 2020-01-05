<?php

/*
 * This file is part of PHP CS Fixer.
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('login');
    }

    public function signin()
    {
        $uname       = trim($this->input->post('uname'));
        $pwd         = trim($this->input->post('pwd'));
	$this->db->select('*');
	$this->db->from('admin_user');
	$this->db->where('username',$uname);
	//$sql = "select * from admin_user where `username` = 'litianfu'";
	$query = $this->db->get();
	$user = $query->result_array();
	if (empty($user) || $user[0]['passwd'] != $pwd) {
		$data = ['code'=>1001,'message'=>'账号或密码错误！'];
		echo json_encode($data);
        }else{
        	//登录成功
		$data = ['code'=>1000,'message'=>'登录成功~~~'];
		echo json_encode( $data);
		$userdata = ['username'=>$uname,'passwd'=>md5($pwd)];
		$this->session->set_userdata('user',$userdata);
	}
    }

    public function logout()
    {
        $user = $this->session->userdata('user');
        $this->session->unset_userdata(array_keys($user));
        header('Location:/login/index');
    }
}
