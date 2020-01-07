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
                $id = $this->input->get('id');
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
                foreach($data as $k =>&$v){
                        unset($v['add_time']);
                        $v['add_time'] = $v['time'];

                }	
		$res['data'] = $data;
		echo json_encode($res);
	}
	public function brandTable(){
		$id = $this->input->get('id');
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
