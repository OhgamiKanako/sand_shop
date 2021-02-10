<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'menu.php'; ?>
	<?php
	 //ログインできてるかどうかの確認(異常処理)
	 if(!isset($_SESSION['customer'])){
		 echo '購入手続きを行うにはログインしてください。';
	//買い物かごが空の場合。(異常処理)
	 }elseif(empty($_SESSION['product'])){
		 echo 'カートに商品がありません！';
	//正常な処理のelse(正常処理)
	 }else{?>
	<!-- PHP処理から抜けるので、HTMLでHP部分を構築できる -->
	<p>お名前：<?= $_SESSION['customer']['name'] ?></p>
	<p>ご住所：<?= $_SESSION['customer']['address'] ?></p>
	<hr>
	<?php require 'cart.php'?>
	<hr>
	<p>内容をご確認いただき、購入を確定してください。</p>
	<a href="purchase_output.php">購入を確定する</a>
	
	<?php
		}
	?>
</body>
</html>