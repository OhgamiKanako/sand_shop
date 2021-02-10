<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>会員登録画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'menu.php'; ?>
	<form action="customer_output.php" method="post">
	<table>
	<tr>
	 <th><label for="name">お名前：</label></th>
	 <td><input type="text" name="name"></td>
	</tr>
	<tr>
	 <th><label for="address">住所：</label></th>
	 <td><input type="text" name="address"></td>
	</tr>
	<tr>
	 <th><label for="login">ログイン名：</label></th>
	 <td><input type="text" name="login"></td>
	</tr>
	<tr>
	 <th><label for="password">パスワード：</label></th>
	 <td><input type="password" name="password"></td>
	</tr>
    <tr><th></th><td><input type="submit" value="登録"></td></tr>
	</table>
    </form>
	</body>
</html>