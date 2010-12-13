<h2>Add new post</h2>

<!--
<ul class="tabs">
    <li><a href="#">Text</a></li>
    <li><a href="#">Link</a></li>
    <li><a href="#">Photo</a></li>
    <li><a href="#">Video</a></li>
</ul>
-->

<form action="<?php echo base_url().'posts/add'; ?>" method="POST">
    <h5>Do you have anything to share? Don't worry. Everything will be posted anonymously. We don't keep track of users.</h5>
    <table>
        <tr>
            <td>Title</td>
            <td><input name="title" /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="description"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>OR</td>
        </tr>
        <tr>
            <td>Link</td>
            <td><input name="link" placeholder="link to any website, image or youtube video"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Post this</button> or
                <a href="javascript:history.back();">Cancel</a>
            </td>
        </tr>
    </table>
</form>