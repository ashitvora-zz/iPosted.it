<?php

class Like extends Model{
    
    function Like(){
        parent::Model();
    }
    
    
    function addLikeness($data){
        $this->db->insert("likes", $data);
    }
    
    
    function removeLikeness($data){
        $this->db->where( array("post_id" => $data["post_id"], "user_id" => $data["user_id"]) );
        $this->db->delete("likes");
    }
    
    
    function getLikenessCountByPost($post_id){
        $this->db->where( array("post_id" => $post_id) );
        return $this->db->count_all_results("likes");
    }
    
    
    function getLikenessStatus($post_id, $user_id){
        $query = $this->db->get_where("likes", array("post_id" => $post_id, "user_id" => $user_id) );
        if ($query->num_rows() > 0){
            return $query->row();
        }
    }
} // end Like Class