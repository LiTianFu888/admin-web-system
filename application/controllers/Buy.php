<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buy extends CI_Controller{

	public function index(){
        	$user = $this->session->userdata('user');
		if(!isset($user)){
        		header('Location:/login/index');
		}
		$this->load->view('buy');
	}
	public function table(){
		$id = $this->input->get('id');
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		if(!empty($id)){
			$this->db->where('id',$id);
		}
		$this->db->select('count(1) as ct');
		$this->db->from('admin_buy');
		$count = $this->db->get()->result_array();
		$res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
		$this->db->select('*,from_unixtime(`add_time`) as time');
		$this->db->from('admin_buy');
		if(!empty($id)){
			$this->db->where('id',$id);
		}
		$data = $this->db->get()->result_array();
		$start = ($page-1)*$limit;
		$data = array_slice($data,$start,$limit);
		foreach($data as $k =>&$v){
			unset($v['add_time']);
			$v['add_time'] = $v['time'];
			switch($v['status']){
				case 'unpayed':
					$v['status']='未付款';
					break;
				case 'payed':
					$v['status']='已付款,待发货';
					break;
				case 'send':
					$v['status']='已发货';
					break;
				case 'succ':
					$v['status']='交易成功';
					break;
				case 'close':
					$v['status']='已关闭';
					break;
			}
		}
		$res['data'] = $data;
		echo json_encode($res);
	}

	public function filter(){
		$this->load->view('order_filter');
	}
	public function filterData(){
		$id = $this->input->get('name');
                $this->db->select('count(1) as ct');
                $this->db->from('admin_order');
                $this->db->where('id',$id);
                $count = $this->db->get()->result_array();
                $res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
                $this->db->select('*,from_unixtime(`add_time`) as time');
                $this->db->from('admin_order');
                $this->db->where('id',$id);
                $data = $this->db->get()->result_array();
                foreach($data as $k =>&$v){
                        unset($v['add_time']);
                        $v['add_time'] = $v['time'];
                        switch($v['status']){
                                case 'unpayed':
                                        $v['status']='未付款';
                                        break;
                                case 'payed':
                                        $v['status']='已付款,待发货';
                                        break;
                                case 'send':
                                        $v['status']='已发货';
                                        break;
                                case 'succ':
                                        $v['status']='交易成功';
                                        break;
                                case 'close':
                                        $v['status']='已关闭';
                                        break;
                        }
                }
                $res['data'] = $data;	
		echo json_encode($res);
	}
	
	public function del(){
		$id =  $this->input->post('id');
		$data = ['status'=>'close'];
		$res=$this->db->update('admin_buy',$data,array('id'=>$id));
		if($res){
		echo 200;
		}
	}

}
