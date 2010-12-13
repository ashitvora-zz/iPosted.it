<?php
class Posts extends Controller {

	function Posts(){
		parent::Controller();
		
		$this->load->model("Post");
		$this->load->model("Comment");
        //$this->load->model("Like");
	}
	
	
	
	// show top 20 Posts
	function index(){
        $posts = $this->Post->getTopPosts();
	    
	    $this->load->view("layout", 
	                        array(  "page" => "posts/index", 
	                                "posts" => $posts
	                            ) 
	                    );
	    
	}
	
	
	function show($id = null){
	    if($id ){
	        $post = $this->Post->getPost($id);
	        $post->description = $this->_get_parsed_link($post->description);
	        $comments = $this->Comment->getCommentsByPost($id);
	        //$likes_count = $this->Like->getLikenessCountByPost($id);
	        //$likeness_status = $this->Like->getLikenessStatus($id, $this->session->userdata("session_id"));
	        
    	    $this->load->view("layout", 
    	                    array(  "page" => "posts/show", 
    	                            "post" => $post, 
    	                            "comments" => $comments
    	                            //"likes_count" => $likes_count, 
    	                            //"likeness_status" => empty($likeness_status) ? null :$likeness_status->likeness
    	                        ) 
    	                    );
		}
		else{
            echo "Broken Link";
		}
	}
	
	function comment($post_id){
        $data = array(
            "post_id" => $post_id,
            "comment" => $this->input->post("comment"),
            "author" => $this->session->userdata("session_id")
        );
        
        $id = $this->Comment->insert($data);
        
        if($id){
            echo json_encode( array("success" => "Comment added successfully") );
	    }
	    else{
            echo json_encode( array("error" => "Error adding comment") );
	    }
	    
	}
	
	
	function flag($post_id){
	    
	}
	
	
	function like($post_id){
	    $data = array(
	       "post_id" => $post_id,
	       "likeness" => $this->input->post("likeness"),
	       "user_id" => $this->session->userdata("session_id")
	    );
	    
	    $this->Like->removeLikeness($data);
	    $this->Like->addLikeness($data);
	    
	    
	    $likes_count = $this->Like->getLikenessCountByPost($post_id);
        //$likeness_status = $this->Like->getLikenessStatus($id, $this->session->userdata("session_id"));
        
        echo json_encode( array("likes_count" => $likes_count) );
	    
	}
	
	
	
	function create(){
        $this->load->view("layout", array("page" => "posts/create") );
	}
	
	
	function add(){
	    
	    $resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
        
        
        if($resp->is_valid){
            
            $data = array(
    	       "title" => $this->input->post("title"),
    	       "description" => $this->input->post("description"),
    	       "author" => $this->session->userdata("session_id")
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
        else{
            $this->session->set_flashdata("error", "Text in the image doesn't match your entered text.");
	        redirect(base_url()."posts/create");
        }
	}
	
	
	
	function _get_parsed_link($data){

        // list of all regex
        // key is regex used to match and value is the regex used to replace (generate new data from the key)
        $reg_exs = array(
            "@^http://www\.youtube\.com/watch\?v=([0-9a-zA-Z]+)@" => $this->load->view('regex/youtube', '', true),
            "@^http://[www\.]?vimeo\.com/([0-9]+)@" => $this->load->view('regex/vimeo', '', true),
            "@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@" => '<a href="$1" target="_blank">$1</a>'
        );

        // loop thru all regex
        foreach($reg_exs as $match => $replacement){
            if( preg_match($match, $data) ){
                return preg_replace($match, $replacement, $data);
            }
        }

        return htmlentities($data);

    }
}