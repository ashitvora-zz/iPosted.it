<?php if($posts): ?>

    <ul class="posts">
        
    <?php foreach($posts as $post): ?>
        
        <li class="post">
            <h2 class="title"><a href="<?php echo base_url()."post/".$post->id; ?>"><?php echo $post->title; ?></a></h2>
            <ul class="metadata">
                <li><? echo $post->created_on; ?></li>
            </ul>
        </li>
        
    <?php endforeach; ?>
    
    </ul>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>