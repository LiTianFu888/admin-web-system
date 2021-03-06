<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods extends CI_Controller{
	public function brand(){
        	$user = $this->session->userdata('user');
		if(!isset($user)){
        		header('Location:/login/index');
		}
		$this->load->view('brand');
	}

	public function manage(){
		
        	$user = $this->session->userdata('user');
		if(!isset($user)){
        		header('Location:/login/index');
		}
		
		$this->load->view('manage');
	}

	public function size(){
        	$user = $this->session->userdata('user');
		if(!isset($user)){
        		header('Location:/login/index');
		}
		$this->load->view('size');
	}
	public function table(){
                $id = $this->input->get('id');
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
                if(!empty($id)){
                        $this->db->where('id',$id);
                }
                $this->db->select('count(1) as ct');
                $this->db->from('admin_product');
                $count = $this->db->get()->result_array();
                $res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
                $this->db->select('*,from_unixtime(`add_time`) as time');
                $this->db->from('admin_product');
                if(!empty($id)){
                        $this->db->where('id',$id);
                }
                $data = $this->db->get()->result_array();
		$start = ($page-1)*$limit;
		$data = array_slice($data,$start,$limit);
                foreach($data as $k =>&$v){
                        unset($v['add_time']);
                        $v['add_time'] = $v['time'];

                }	
		$res['data'] = $data;
		echo json_encode($res);
	}
	public function brandTable(){
		$id = $this->input->get('id');
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		if(!empty($id)){
			$this->db->where('id',$id);
		}
		$this->db->select('count(1) as ct');
		$this->db->from('admin_brand');
		$count = $this->db->get()->result_array();
		$res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
		$this->db->select('*,from_unixtime(`add_time`) as time');
		$this->db->from('admin_brand');
		if(!empty($id)){
			$this->db->where('id',$id);
		}
		$data = $this->db->get()->result_array();
		$start = ($page-1)*$limit;
		$data = array_slice($data,$start,$limit);
		foreach($data as $k =>&$v){
			unset($v['add_time']);
			$v['add_time'] = $v['time'];

		}
		$res['data'] = $data;
		echo json_encode($res);
	}
	public function brandDel(){
		$id = $this->input->post('id');
		$data = ['is_del'=>'yes','updata_time'=>time()];
		$res=$this->db->update('admin_brand',$data,array('id'=>$id));
		if($res){
		echo 200;
		}
	
	}
	public function Del(){
		$id = $this->input->post('id');
		$data = ['offset'=>'yes','update_time'=>time()];
		$res=$this->db->update('admin_product',$data,array('id'=>$id));
		if($res){
		echo 200;
		}
	}
}
