<?php

class User extends CI_Controller{

	public function index(){
        	$user = $this->session->userdata('user');
		if(!isset($user)){
        		header('Location:/login/index');
		}
		$this->load->view('user');
	}

	public function ban(){
		$id = $this->input->post('id');
		$data = ['ban'=>'yes','update_time'=>time()];
		$res=$this->db->update('user',$data,array('id'=>$id));
		if($res){
			echo 200;
		}
		else{
			echo 404;
		}
	}

        public function free(){
                $id = $this->input->post('id');
                $data = ['ban'=>'no','update_time'=>time()];
                $res=$this->db->update('user',$data,array('id'=>$id));
                if($res){
                echo 200;
                }else{
		echo 404;
		}
        }	

	public function table(){
                $id = $this->input->get('id');
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
                if(!empty($id)){
                        $this->db->where('id',$id);
			$this->db->or_where('name', $id); 
                }
                $this->db->select('count(1) as ct');
                $this->db->from('user');
                $count = $this->db->get()->result_array();
                $res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
                $this->db->select('*,from_unixtime(`add_time`) as time');
                $this->db->from('user');
                if(!empty($id)){
                        $this->db->where('id',$id);
			$this->db->or_where('name', $id); 
                }
                $data = $this->db->get()->result_array();
		$start = ($page-1)*$limit;
		$data = array_slice($data,$start,$limit);
                foreach($data as $k =>&$v){
                        unset($v['add_time']);
                        $v['add_time'] = $v['time'];
			if($v['ban']=='no'){
				unset($v['ban']);
				unset($v['reson']);
				$v['ban'] = '未封禁';
			}else{
				unset($v['ban']);
				$v['ban'] = "封禁中";
			}

                }
                $res['data'] = $data;
                echo json_encode($res);
		
	}
}
