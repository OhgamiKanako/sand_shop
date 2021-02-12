<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入履歴画面</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php require 'menu.php'; ?>
	<?php
	//ログインの確認 
	 if(isset($_SESSION['customer'])){
		 //mysqlデータベースに接続する。
		 require 'db_connect.php';
		 //purchaseテーブルから、ユーザーをピックアップ
		 //SQL文を作る（プレースホルダを使った式）
		 $sql = "select * from purchase where customer_id = :customer_id";
	 	 //プリペアードステートメントを作る
		 $stm = $pdo->prepare($sql);
		 //プリペアードステートメントに値をバインドする
		 $stm->bindValue(':customer_id',$_REQUEST['customer']['id'],PDO::PARAM_STR);
		 //SQL文を実行する
		 $stm->execute();
		 //結果の取得（連想配列で受け取る）
		 $result = $stm->fetchAll(PDO::FETCH_ASSOC);

		 //ピックアップしたユーザーが、purchase_detailに入ってる？
		 foreach($result as $row){
			 $sql_a = "select * from purchase_detail where purchase_id = :purchase_id";
			 $stm_a = $pdo->prepare($sql_a);
			 $stm_a->bindValue(':purchase_id',$row['customer_id'],PDO::PARAM_STR);
			 $stm_a->execute();
			 $result_a = $stm_a->fetchAll(PDO::FETCH_ASSOC);
		}
		 ?>
		
	<!-- 以下はカートの表示形式 -->
	<table>
		<th>商品番号</th>
		<th>商品名</th>
		<th>価格</th>
		<th>個数</th>
		<th>小計</th>
		<?php
		//purchase_detailテーブルからピックアップしたidと、productテーブルとを比較。
		$total = 0;
		foreach ($result_a as $product) {
			$sql_b = "select * from product where id = :purchase_id";
			$stm_b = $pdo->prepare($sql_a);
			$stm_b->bindValue(':purchase_id',$row2['product_id'],PDO::PARAM_STR);
			$stm_b->execute();
			$result_b = $stm_a->fetchAll(PDO::FETCH_ASSOC);
			foreach($result_b as $product){
		?>
			<tr>
				<td><?= $id ?></td>
				<td><a href="detail.php?id=<?= $id ?>"><?= $product['name'] ?></a></td>
				<td><?= $product['price'] ?></td>
				<td><?= $product['count'] ?></td>
				<?php
				$subtotal = $product['price'] * $product['count'];
				$total += $subtotal;
				?>
				<td><?= $subtotal ?></td>
			</tr>
		<?php } ?>
		<?php }?>
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

<?php　}else{ ?>
　購入履歴を表示するには、ログインしてください。
<?php } ?>
</body>
</html>