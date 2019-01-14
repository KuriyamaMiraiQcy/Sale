<?php
/**
 * Created by PhpStorm.
 * User: Raymond
 * Date: 2018/10/31
 * Time: 16:31
 */

class Book_model extends CI_Model{

    var $table='books';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_books(){
		$this->db->from('books');
		$result = $this->db->get();
		return $result->result();
    }

    public function book_add($data){
        $id = $this->db->insert($this->table,$data);
        return $this->db->insert_id();

    }

    public function get_by_id($id)
	{
		$this->db->from('books');
		$this->db->where('book_id', $id);
		$result = $this->db->get();
		return $result->row();
	}

	public function book_update($id, $data)
	{
		$this->db->update($this->table, $data, array('book_id'=>$id));
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('book_id', $id);
		$this->db->delete($this->table);
	}
}
