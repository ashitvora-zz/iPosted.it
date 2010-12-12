<h1 class="title"><?php echo $post->title; ?></h1>
<p class="description"><?php echo $post->description; ?></p>
<div class="metadata">
    <span class="likes_count">
        <?php
            $like_word = $likes_count == 1 ? "Like" : "Likes";
            echo $likes_count." ".$like_word;
        ?>
    </span>
    <span class="my_likeness">
        <?php
            // is either not liked of is unliked
            if( (!$likeness_status) || $likeness_status < 0){
                echo "<a href='#' class='like_it' data-id='$post->id'>Like</a>";
            }
            else{
                echo "<a href='#' class='unlike_it' data-id='$post->id'>Unlike</a>";
            }
        ?>
    </span>
</div>
<div class="blankspace"></div>



<form class="comment" action="<?php base_url()."posts/comment/".$post->id; ?>" method="POST">
    <textarea name="comment" class="comment"></textarea>
    <button type="submit">Post this comment</button>
</form>
<div class="blankspace"></div>




<ul class="comments">
    <?php foreach($comments as $comment): ?>
        <li class="comment" id="comment_<?php echo $comment->id; ?>">
            <p class="comment"><?php echo $comment->comment; ?></p>
            <p class="metadata">
                by <?php echo $comment->author; ?> 
                on <?php echo date( "d-m-Y", strtotime($comment->created_on) ); ?>
            </p>
        </li>
    <?php endforeach; ?>
</ul>



<script charset="utf-8">
    var commentsList = $("ul.comments");
    $("form.comment").submit(function(e){
        e.preventDefault();
        var self = $(this),
            comment = self.find("textarea").val();
            
        //post this comment
        $.post(
            "<?php echo base_url()."post/comment/".$post->id; ?>",
            {
                comment : comment
            }, 
            function(r){
            
                if(r.success){
                    var new_comment = ["<li class='comment>",
                                            "<p class='comment'>"+ comment +"</p>",
                                            "<p class='metadata'></p>",
                                        "</li>"].join("");
                
                    commentsList.prepend(new_comment);
                }
            
            },
            "json"
        ); // end $.post
        
    }); // end submit handler
    
    
    
    
    // Like / Unlike
    // when user likes / unlikes something. 
    //      change the link
    //      change the likeness count
    
    $("div.metadata").delegate(".like_it, .unlike_it", "click", function(e){
        e.preventDefault();
        
        var self = $(this),
            likeness = self.hasClass("like_it") ? 1 : -1;
        
        $.post(
            "<?php echo base_url()."post/like/".$post->id; ?>",
            {
                likeness: likeness
            },
            function(r){
                if(r.likes_count){
                    $("div.metadata").find("span.likes_count").text(r.likes_count +" "+ (r.likes_count == 1 ? "Like" : "Likes") );
                    
                    // I liked it. Now show unlike link
                    if(likeness == 1){
                        var link = "<a href='#' class='unlike_it'>Unlike</a>";
                        $("div.metadata").find("span.my_likeness").html(link);
                    }
                    else{
                        // I unliked it. show like link
                        var link = "<a href='#' class='like_it'>Like</a>";
                        $("div.metadata").find("span.my_likeness").html(link);
                    }
                }
            },
            "json"
        ); //end $.post
        
        
    });
</script>