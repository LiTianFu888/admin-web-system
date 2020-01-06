<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods extends CI_Controller{
	public function brand(){
		$this->load->view('brand');
	}

	public function manage(){
		$this->load->view('manage');
	}

	public function size(){
		$this->load->view('size');
	}
	public function table(){
		
		$res = ['code'=>0,'msg'=>'','count'=>11];
		$data = [
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
				['id'=>1,'username'=>'test','sex'=>'2'],
			];
		$res['data'] = $data;
		echo json_encode($res);
	}
}
