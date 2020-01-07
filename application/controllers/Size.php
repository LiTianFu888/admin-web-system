<?php

class Size extends CI_Controller{

	public function index(){
		$this->load->view('size');
	}
	public function table(){
                $id = $this->input->get('id');
                if(!empty($id)){
                        $this->db->where('id',$id);
                }
                $this->db->select('count(1) as ct');
                $this->db->from('admin_size');
                $count = $this->db->get()->result_array();
                $res = ['code'=>0,'msg'=>'','count'=>$count[0]['ct']];
                $this->db->select('*,from_unixtime(`add_time`) as time');
                $this->db->from('admin_size');
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

	public function del(){
                $id = $this->input->post('id');
		$res = $this->db->delete('admin_size',array('id'=>$id));
                if($res){
                echo 200;
                }
	}

}
