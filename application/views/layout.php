<?php
    $app_name = "iPosted.it";
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $app_name; ?></title>
        <meta charset="utf-8"/>
        <script charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Nobile:regular,bold' rel='stylesheet' type='text/css'>
        
        <style>
            body{
                background-color: #fff;
                font-family: Lucida Grande, Verdana, Sans-serif;
                font-size: 14px;
                color: #4F5155;
            }

            a{
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }
            
            .clear{
                clear: both;
            }
            
            .blankspace{
                margin: 3em 0;
            }
            
            .error{
                background: #ffbabb;
                color: #d9001a;
            }
            
            .success{
                background: #dff2c5;
                color: #4e8a2d;
            }
            
            .error, .success{
                padding: 5px;
                border: 1px solid;
            }
            
            .logo{
                display: inline;
            }
            
            .logo a{
                color: #4161A6;
                font-family: Nobile, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: bold;
                letter-spacing: 0px;
                line-height: 1em;
                text-decoration: none;
                text-shadow: none;
                text-transform: none;
                word-spacing: 0em;
                text-decoration: none;
            }
            
            
            /* TOP NAVMENU ---------------------------------------------------*/
            nav, .top-nav{
                margin: 0;
                padding: 5px;
                list-style: none;
                background: #f3f3f3;
            }
            
            .top-nav li{
                display: inline;
                margin-right: 10px;
            }
            
            .top-nav.left{
                float: left;
            }
            
            .top-nav.right{
                float: right;
            }
            
            
            /* Main Section --------------------------------------------------*/
            body > .main-section{
                position: relative;
                margin-bottom: 20px;
            }
            
            #main{
                position: relative;
                float: left;
                margin-right: 300px;
            }
            
            #sidebar{
                width: 280px;
                padding: 10px;
                z-index: 100;
                position: relative;
                top: 0;
                right: 0;
                float: right;
            }
            
            
            /* POSTS ---------------------------------------------------------*/
            .posts{
                margin: 0;
                padding: 0;
            }
            
            .posts .title{
                margin-bottom: 0;
            }
            
            .posts .title a{
                text-decoration: none;
            }
            
            .posts li.post{
                list-style: none;
                margin: 0;
                padding: 0;
            }
            
            .posts .post ul.metadata{
                list-style: none;
                margin: 0;
                padding: 0;
            }
            
            .posts .post ul.metadata li{
                display: inline;
                font-size: 0.7em;
            }
            
            
            /* Leader Board ----------------------------*/
            .leader-board .leader{
                width: 80px;
                height: 80px;
                margin: 0 10px 10px 0;
                float: left;
                background: #f3f3f3;
            }
            
            
            /* New POST --------------------------------*/
            form table td{
                vertical-align: top;
            }
            
            form input, form textarea{
                width: 400px;
                font-size: 1.1em;
                padding: 5px;
            }
            
            form textarea{
                width: 400px;
                height: 75px;
            }
            
            /* Comment Box ---------------------------- */
            textarea.comment{
                display: block;
                margin-bottom: 10px;
            }
            
            ul.comments{
                margin: 0;
                padding: 0;
                list-style: none;
            }
            
            ul.comments li.comment{
                margin-bottom: 20px;
            }
            
            ul.comments li.comment p.metadata{
                font-size: 0.75em;
                color: #666;
            }
            
            ul.comments li.comment p.metadata, ul.comments li.comment p.comment{
                margin: 0;
            }
            
            
            /* Individual Post -----------------------------------------------*/
            h1.title{
                
            }
            
            div.metadata{
                font-size: 0.75em;
            }
            
            
            
            
            /* FOOTER ----------------------------------*/
            .footer{
                position: fixed;
                bottom: 0;
                right: 0;
                z-index: 100;
                background: #f2f2f2;
                padding: 3px;
                font-size: 0.8em;
                text-align: center;
                vertical-align: middle;
                display: block;
                width: 100%;
                border-top: 1px solid #999;
            }
        </style>
    </head>
    
    <body>
        <nav>
            <ul class="top-nav">
                <li><h1 class="logo"><a href="<?php echo base_url(); ?>"><?php echo $app_name; ?></a></h1></li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url()."new"; ?>">Submit New</a></li>
            </ul>
        </nav>
        
        <section class="main-section">
            <?php
                $success_msg = $this->session->flashdata("success");
                if( $success_msg ){
                    echo "<p class='success'>$success_msg</p>";
                }
                
                
                $error_msg = $this->session->flashdata("error");
                if( $error_msg ){
                    echo "<p class='error'>$error_msg</p>";
                }
            ?>
            <content id="main">
                <?php $this->load->view($page); ?>
            </content>
        
            <!-- sidebar -->
            <!--
            <aside id="sidebar">
                <section>
                    <a href="<?php echo base_url()."posts/create"; ?>">Add new post</a>
                </section>
                <section class="leader-board">
                    <h4>Leaders</h4>
                    <div class="leader"></div>
                    <div class="leader"></div>
                    <div class="leader"></div>
                    <div class="leader"></div>
                    <div class="leader"></div>
                    <div class="leader"></div>
                    <div class="clear"></div>
                </section>
            </aside>
            -->
        </section>
        
        
        
        <div class="footer">
            &copy; <?php echo $app_name; ?> | Session ID:  <?php echo $this->session->userdata("session_id"); ?>
        </div>
    </body>
</html>