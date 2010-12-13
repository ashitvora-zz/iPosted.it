<h1 class="title"><?php echo $post->title; ?></h1>
<p class="metadata">
    <span><?php echo $post->created_on; ?></span>
    <span><a href="<?php echo base_url()."post/flag/".$post->id; ?>">Flag</a></span>
</p>
<p class="description"><?php echo $post->description; ?></p>


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
                time: <?php echo date( "d-m-Y", strtotime($comment->created_on) ); ?>
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
    });
</script>