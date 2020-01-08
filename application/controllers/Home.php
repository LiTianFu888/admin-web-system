<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
	public function index(){
        	$user = $this->session->userdata('user');
		if(!isset($user)){
        		header('Location:/login/index');
		}
		$data['test'] = 'data from hello';
		$this->load->view('home',$data);
	}
	public function echart12()
    {
        $sql="select goods_id,sum(cost) from admin_order group by goods_id order by sum(cost) desc";
        $query=$this->db->query($sql);
        $data = $query->result_array();
        $data1=[
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
        ];
        $data2=[];
        for($i=0;$i<5;$i++) {
            $sql="select * from admin_product where id=".$data1[$i]['goods_id'];
            $query=$this->db->query($sql);
            $data2[] = $query->result_array();
        }
        $data3=[
            ['value'=>intval($data1[0]['sum(cost)']),'name'=>$data2[0][0]['name']],
            ['value'=>intval($data1[1]['sum(cost)']),'name'=>$data2[1][0]['name']],
            ['value'=>intval($data1[2]['sum(cost)']),'name'=>$data2[2][0]['name']],
            ['value'=>intval($data1[3]['sum(cost)']),'name'=>$data2[3][0]['name']],
            ['value'=>intval($data1[4]['sum(cost)']),'name'=>$data2[4][0]['name']],
        ];
        echo json_encode($data3);
    }
    public function linechart1()
    {
        $sql="select goods_id,count(id) from admin_order group by goods_id order by count(id) desc";
        $query=$this->db->query($sql);
        $data = $query->result_array();
        $data1=[
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
        ];
        $data2=[];
        for($i=0;$i<5;$i++) {
            $sql="select * from admin_product where id=".$data1[$i]['goods_id'];
            $query=$this->db->query($sql);
            $data2[] = $query->result_array();
        }
        $data3=[
            ['value'=>intval($data1[0]['count(id)']),'name'=>$data2[0][0]['name']],
            ['value'=>intval($data1[1]['count(id)']),'name'=>$data2[1][0]['name']],
            ['value'=>intval($data1[2]['count(id)']),'name'=>$data2[2][0]['name']],
            ['value'=>intval($data1[3]['count(id)']),'name'=>$data2[3][0]['name']],
            ['value'=>intval($data1[4]['count(id)']),'name'=>$data2[4][0]['name']],
        ];
        echo json_encode($data3);
    }
    public function echart34()
    {
        $sql="select seller_id,sum(cost) from admin_order group by seller_id order by sum(cost) desc";
        $query=$this->db->query($sql);
        $data = $query->result_array();
        $data1=[
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
        ];
        $data2=[];
        for($i=0;$i<5;$i++) {
            $sql="select * from admin_brand where id=".$data1[$i]['seller_id'];
            $query=$this->db->query($sql);
            $data2[] = $query->result_array();
        }
		
        $data3=[
            ['value'=>intval($data1[0]['sum(cost)']),'name'=>$data2[0][0]['name']],
            ['value'=>intval($data1[1]['sum(cost)']),'name'=>$data2[1][0]['name']],
            ['value'=>intval($data1[2]['sum(cost)']),'name'=>$data2[2][0]['name']],
            ['value'=>intval($data1[3]['sum(cost)']),'name'=>$data2[3][0]['name']],
            ['value'=>intval($data1[4]['sum(cost)']),'name'=>$data2[4][0]['name']],
        ];
        echo json_encode($data3);
    }
    public function linechart2()
    {
        $sql="select seller_id,count(id) from admin_order group by seller_id order by count(id) desc";
        $query=$this->db->query($sql);
        $data = $query->result_array();
        $data1=[
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
        ];
        $data2=[];
        for($i=0;$i<5;$i++) {
            $sql="select * from admin_brand where id=".$data1[$i]['seller_id'];
            $query=$this->db->query($sql);
            $data2[] = $query->result_array();
        }
        $data3=[
            ['value'=>intval($data1[0]['count(id)']),'name'=>$data2[0][0]['name']],
            ['value'=>intval($data1[1]['count(id)']),'name'=>$data2[1][0]['name']],
            ['value'=>intval($data1[2]['count(id)']),'name'=>$data2[2][0]['name']],
            ['value'=>intval($data1[3]['count(id)']),'name'=>$data2[3][0]['name']],
            ['value'=>intval($data1[4]['count(id)']),'name'=>$data2[4][0]['name']],
        ];
        echo json_encode($data3);
    }
}
