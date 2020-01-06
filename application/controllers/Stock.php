<?php

class Stock extends CI_Controller{
	public function index(){
		$this->load->view('stock');
	}
	
	public function table(){
	
		$this->db->select('count(1) as ct');
		$this->db->from('admin_stock');
		$count = $this->db->get()->result_array();
		$res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
		$this->db->select('*,from_unixtime(`add_time`) as time');
		$this->db->from('admin_stock');
		$data = $this->db->get()->result_array();
		foreach($data as $k =>&$v){
			unset($v['add_time']);
			$v['add_time'] = $v['time'];
		}
		$res['data']= $data;
		echo json_encode($res);
	}
}
