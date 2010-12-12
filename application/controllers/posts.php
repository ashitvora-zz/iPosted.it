<?php

class Posts extends Controller {

	function Posts(){
		parent::Controller();
		
		$this->load->model("Post");
		$this->load->model("Comment");
        $this->load->model("Like");
	}
	
	
	
	// show top 20 Posts
	function index($type = "top"){
	    
	    switch($type){
	        case "top":
	            $posts = $this->Post->getTopPosts();
	            break;
	            
	        case "hot":
	            $posts = $this->Post->getTopPosts();
	            break;
	            
	        case "recent":
	            $posts = $this->Post->getTopPosts();
	            break;
	            
	        case "saved" :
	            $posts = $this->Post->getTopPosts();
	            break;
	            
	        default:
	            $posts = $this->Post->getTopPosts();
	    }
	    
	    $this->load->view("layout", array("page" => "posts/index", "posts" => $posts) );
	    
	}
	
	
	function show($id = null){
	    if($id ){
	        $post = $this->Post->getPost($id);
	        $comments = $this->Comment->getCommentsByPost($id);
	        $likes_count = $this->Like->getLikenessCountByPost($id);
	        $likeness_status = $this->Like->getLikenessStatus($id, 123);
	        
    	    $this->load->view("layout", array("page" => "posts/show", "post" => $post, "comments" => $comments, "likes_count" => $likes_count, "likeness_status" => $likeness_status->likeness) );
		}
		else{
            echo "Broken Link";
		}
	}
	
	
	function recent(){
	    
	}
	
	
	function saved(){
	    
	}
	
	
	function comment($post_id){
        $data = array(
            "post_id" => $post_id,
            "comment" => $this->input->post("comment"),
            "author" => 123
        );
        
        $id = $this->Comment->insert($data);
        
        if($id){
            echo json_encode( array("success" => "Comment added successfully") );
	    }
	    else{
            echo json_encode( array("error" => "Error adding comment") );
	    }
	    
	}
	
	
	function like($post_id){
	    $data = array(
	       "post_id" => $post_id,
	       "likeness" => $this->input->post("likeness"),
	       "user_id" => 123
	    );
	    
	    $this->Like->removeLikeness($data);
	    $this->Like->addLikeness($data);
	    
	    
	    $likes_count = $this->Like->getLikenessCountByPost($post_id);
        //$likeness_status = $this->Like->getLikenessStatus($id, 123);
        
        echo json_encode( array("likes_count" => $likes_count) );
	    
	}
	
	
	
	function create(){
        $this->load->view("layout", array("page" => "posts/create") );
	}
	
	
	function add(){
	    $data = array(
	       "title" => $this->input->post("title"),
	       "description" => $this->input->post("description"),
	       "author" => 123
	    );
	    
	    $id = $this->Post->insert($data);
	    
	    if($id){
	        $this->session->set_flashdata("success", "Post added successfully");
	        redirect(base_url()."post/".$id);
	    }
	    else{
	        $this->session->set_flashdata("error", "Error adding this post.");
	        redirect(base_url()."posts/create");
	    }
	}
}