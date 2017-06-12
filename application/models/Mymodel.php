<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model{

	public $table = 'user';
	
	public function create($data){
		$t = $this->table;
		$query = $this->db->insert($t,$data);
		return $query;
	}

	public function read($field='',$id=''){
		$t = $this->table;
		if($id != ''){
			$this->db->where('category_id',$id);
		}
		$this->db->order_by($field, 'ASC');
		$query = $this->db->get($t);
		return $query;
	}

	public function read2($gets='', $offset=''){
		$t = $this->table;
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($t,$gets,$offset);
		return $query;
	}

	public function read_by_id($id){
		$t = $this->table;
    	$query = $this->db->get_where($t, array('id' => $id));
    	return $query->row();
    }

	public function update($id, $data){
		$t = $this->table;

		$this->db->where('id',$id);
		$query = $this->db->update($t,$data);
		return $query;
	}

    public function delete($id){
    	$t = $this->table;

	    return $this->db->delete($t, array('no_induk' => $id));
	}

	public function getnilai($id){
        $this->db->select('nilais.*, category.id as cid, category.name as cname');
        $this->db->from('nilais');
        $this->db->join('category', 'category.id = nilais.category_id');
        $this->db->where('nilais.id',$id);
        $query = $this->db->get();
        return $query;
    }

    public function getMenu(){
    	return $this->db->get('category');
    }
    
    public function cek($u='', $p=''){
		$q = $this->db->get_where('user', array('username' => $u, 'password' => $p));
		if($q->num_rows() == 1){
			$row = $q->row();
			$this->session->set_userdata(
				array(
		              'isLogin' => true,
		              'user_id' => $row->id,
		              'username' => $row->username,
		            ));
			return true;
		}else{
			return false;
		}
	}
}
 ?>