<div id="header">
	<header>
        <a href="/products">eBuy</a>
<?php
	if($this->session->userdata('user_id') != null){
?>
		<a href="/users/logoff">Log off</a>
<?php
		if(!$this->session->userdata('is_admin')){
?>
		<a href="/users/profile">Settings</a>
		<a href="/users/carts">Shopping Cart (<?= $cart_count['total'] ?>)</a>
<?php	
		}else{
?>
		<a href="/dashboard/orders">Orders</a>
		<a href="/">Products</a>
<?php
		}

	}else{
?>
        <a href="/users/login">Login</a>
        <a href="/users/register">Register</a>
<?php
	}
?>
	</header>  
</div>