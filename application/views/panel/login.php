<div id="wrapper">
    <div class="login">
        <h1><img class="responsive" src="<?php echo base_url() ?>asset/image/panel/logo.png" alt="Preloode Logo"></h1>
        <div class="back">
            <i class="back-grey square-30 back"></i>
        </div>
        <h2 class="l-font">Sign In</h2>
        <div class="clearfix"></div>
        <div class="picture">
            <img class="responsive user" src="<?php echo base_url() ?>asset/image/panel/administrator/administrator_picture.png" alt="<?php echo $this->config->item('site_name') ?> Administrator Profile Picture">
        </div>
        <div class="m-font name">Guest</div>
        <form method="post" action="">
            <div class="animation">
            	<input class="m-font username" name="username" type="text" placeholder="Username">
                <input class="m-font password" name="password" type="password" placeholder="Password">
            </div>
            <button class="blue m-font next" name="next" type="submit">Next</button>
            <button class="blue m-font login" name="login" type="submit">Sign In</button>
        </form>
    </div>