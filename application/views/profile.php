<div id="content">
	<div class="wrapper">
    	<div class="content tabs">
        	<ul>
            	<li><a href="#profile">Data Akun</a></li>
                <li><a href="#change-password">Ubah Kata Sandi</a></li>
            </ul>
            <form method="post" action="">
                <div id="profile" class="tab">
                    <p class="title m-font">Nama Pengguna</p>
                    <input class="username" name="username" type="text" placeholder="Nama Pengguna">
                    <div class="clear"></div>
                    <p class="title m-font">Email</p>
                    <input class="email" name="email" type="text" placeholder="Email">
                    <div class="clear"></div>
                    <p class="title m-font">Nama Rekening</p>
                    <input class="bank-account-name" name="bank-account-name" type="text" placeholder="Nama Rekening">
                    <div class="clear"></div>
                    <p class="title m-font">Nomor Pengguna</p>
                    <input class="bank-account-number" name="bank-account-number" type="text" placeholder="Nomor Pengguna">
                    <div class="clear"></div>
                    <p class="title m-font">Nomor Telepon</p>
                    <input class="phone" name="phone" type="text" placeholder="Nomor Telepon">
                    <img class="edit-phone responsive" src="<?php echo base_url() ?>asset/image/edit_icon_green.png" alt="Edit Indo Poker League Icon">
                    <div class="clear"></div>
                    <button class="update m-font" name="update" type="submit">Kirim</button>
                </div>
            </form>
            <form method="post" action="">
                <div id="change-password" class="tab">
                    <p class="title m-font">Kata Sandi Sekarang</p>
                    <input class="password" name="password" type="password" placeholder="Kata Sandi Sekarang">
                    <div class="clear"></div>
                    <p class="title m-font">Kata Sandi Baru</p>
                    <input class="new-password" name="new-password" type="password" placeholder="Kata Sandi Baru">
                    <div class="clear"></div>
                    <p class="title m-font">Konfirmasi Kata Sandi Baru</p>
                    <input class="confirm-new-password" name="confirm-new-password" type="password" placeholder="Konfirmasi Kata Sandi Baru">
                    <div class="clear"></div>
                    <button class="update m-font" name="update" type="submit">Kirim</button>
                </div>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>