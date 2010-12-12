<?php

class Post extends Model{
    
    function Post(){
        parent::Model();
    }
    
    
    function insert($data){
        $query = $this->db->insert("posts", $data);
        
        if($query){
            return $this->db->insert_id();
        }
        else{
            return false;
        }
    }
    
    
    function getPost($id){
        $query = $this->db->get_where("posts", array("id" => $id) );
        return $query->row();
    }
    
    
    function getTopPosts(){
        $query = $this->db->get("posts");
        return $query->result();
    }
    
}