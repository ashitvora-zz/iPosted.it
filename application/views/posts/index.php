<?php if($posts): ?>

    <ul class="posts">
        
    <?php foreach($posts as $post): ?>
        
        <li class="post">
            <h4 class="title"><a href="<?php echo base_url()."post/".$post->id; ?>"><?php echo $post->title; ?></a></h4>
            <ul class="metadata">
                <li>12 points</li>
                <li>by John Smith</li>
                <li>7 hours ago</li>
                <li>32 comments</li>
            </ul>
        </li>
        
    <?php endforeach; ?>
    
    </ul>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>