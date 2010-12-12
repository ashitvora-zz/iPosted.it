<?php

class Comment extends Model{
    
    function Comment(){
        parent::Model();
    }
    
    
    function getCommentsByPost($post_id){
        $query = $this->db->get_where("comments", array("post_id" => $post_id) );
        return $query->result();
    }
    
    function insert($data){
        $query = $this->db->insert("comments", $data);
        return $this->db->insert_id();
    }
}