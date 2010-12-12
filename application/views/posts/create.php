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
            <td>
                <button type="submit">Post this</button> or
                <a href="javascript:history.back();">Cancel</a>
            </td>
        </tr>
    </table>
</form>