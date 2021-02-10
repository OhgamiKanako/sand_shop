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
	 require 'db_connect.php';
	 //purchaseテーブル最終行 id+1を取得
	 $purchase_id = 1;
	 foreach($pdo->query('select max(id) from purchase') as $row){
		 $purchase_id = $row['max(id)']+1;
	 }
	 //SQL文を作っちゃおう。
	 $sql = "insert into purchase values(:id,:customer_id)";
	 //プリペアードステートメントを作る
	 $stm = $pdo->prepare($sql);
	 //プリペアードステートメントに値を紐付けする。
	 $stm->bindValue(':id',$purchase_id, PDO::PARAM_INT);
	 $stm->bindValue(':customer_id',$_SESSION['customer']['id'], PDO::PARAM_INT);
	 if($stm->execute()){
		 //sqlに登録出来た。
		 //セッションに入っている商品の数だけpurchase_detailに保存しちゃおう。
		 foreach($_SESSION['product'] as $product_id => $product){
			 //sql文を作る（プレースホルダーを使った式）
			 $sql = "insert into purchase_detail values(:purchase_id,:product_id,:count)";
			 //プリペアードステートメント作成。
			 $stm = $pdo->prepare($sql);
			 //プリペアードステートメントに値をバインドする
			 $stm->bindValue(':purchase_id',$purchase_id, PDO::PARAM_INT);
			 $stm->bindValue(':product_id',$product_id, PDO::PARAM_INT);
			 $stm->bindValue(':count',$product['count'], PDO::PARAM_INT);
			 //SQL文を実行する。
			 $stm->execute();
		 }
		 //買い物が終わったら、カートの中身を消さなければ。
		 unset($_SESSION['product']);
		 echo "購入手続きが完了いたしました。ありがとうございます。";
	 }else{
		 //sqlに登録できなかった。
		 echo "購入手続き中にエラーが発生いたしました。申し訳ございません。";
	 }
	?>
</body>
</html>