<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入履歴画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php
	require 'menu.php';
	if (isset($_SESSION['customer'])) { ?>
		<!-- ログイン後の場合 -->
		<!-- purchase、purchase_detail、productテーブルからすべて表示する -->
		<?php
		//MySQLデータベースに接続する
		require 'db_connect.php';

		//SQL文を作る（プレースホルダを使った式）
		$sql = "select id from purchase where customer_id = :customer_id";
		//プリペアードステートメントを作る
		$stm = $pdo->prepare($sql);
		//プリペアードステートメントに値をバインドする
		$stm->bindValue(':customer_id', $_SESSION['customer']['id'], PDO::PARAM_STR);
		//SQL文を実行する
		$stm->execute();
		//結果の取得（連想配列で受け取る）
		$result1 = $stm->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result1 as $r) {
			$total = 0;
			$sql = "select * from purchase_detail where purchase_id = :purchase_id";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(':purchase_id', $r['id'], PDO::PARAM_STR);
			$stm->execute();
			$result2 = $stm->fetchAll(PDO::FETCH_ASSOC);
		?>
			<table>
				<th>商品番号</th>
				<th>商品名</th>
				<th>価格</th>
				<th>個数</th>
				<th>小計</th>
				<?php
				foreach ($result2 as $product) {
					$sql = "select * from product where id = :purchase_id";
					$stm = $pdo->prepare($sql);
					$stm->bindValue(':purchase_id', $product['product_id'], PDO::PARAM_STR);
					$stm->execute();
					$result3 = $stm->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result3 as $p_key) {
				?>
						<tr>
							<td><?= $p_key['id'] ?></td>
							<td><a href="detail.php?id=<?= $p_key['id'] ?>"><?= $p_key['name'] ?></a></td>
							<td><?= $p_key['price'] ?></td>
							<td><?= $product['count'] ?></td>
							<?php
							$subtotal = $p_key['price'] * $product['count'];
							$total += $subtotal;
							?>
							<td><?= $subtotal ?></td>
						</tr>
				<?php
					}
				}
				?>
				<tr>
					<td>合計</td>
					<td></td>
					<td></td>
					<td></td>
					<td><?= $total ?></td>
					<td></td>
				</tr>
			</table>
			<hr>
		<?php
		}
		?>

	<?php } else { ?>
		<p>購入履歴を表示するには、ログインしてください。</p>
	<?php } ?>
</body>

</html>
