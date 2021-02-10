create table product (
	id int auto_increment primary key, 
	name varchar(200) not null, 
	price int not null
);

create table customer (
	id int auto_increment primary key, 
	name varchar(100) not null, 
	address varchar(200) not null, 
	login varchar(100) not null unique, 
	password varchar(100) not null
);

create table purchase (
	id int not null primary key, 
	customer_id int not null, 
	foreign key(customer_id) references customer(id)
);

create table purchase_detail (
	purchase_id int not null, 
	product_id int not null, 
	count int not null, 
	primary key(purchase_id, product_id), 
	foreign key(purchase_id) references purchase(id), 
	foreign key(product_id) references product(id)
);

create table favorite (
	customer_id int not null, 
	product_id int not null, 
	primary key(customer_id, product_id), 
	foreign key(customer_id) references customer(id), 
	foreign key(product_id) references product(id)
);

insert into product values(null, 'トマト', 300);
insert into product values(null, 'ブロッコリー', 270);
insert into product values(null, 'じゃがいも', 230);
insert into product values(null, '玉ねぎ', 220);
insert into product values(null, 'にんじん', 200);
insert into product values(null, 'きゅうり', 150);
insert into product values(null, 'なす', 400);
insert into product values(null, 'ピーマン', 450);
insert into product values(null, 'キャベツ', 100);
insert into product values(null, 'もやし', 50);
insert into product values(null, 'にら', 180);

INSERT INTO `customer` (`id`, `name`, `address`, `login`, `password`) VALUES
(1, '伊藤 直也', ' 東京都千代田区神田神保町2-10-33', 'ito_naoya', 'naoya_ito'),
(2, '藤川 真一', '東京都豊島区東池袋1-20-17', 'fujikawa', 'fshin2000'),
(3, '山本 裕介', '神奈川県横浜市神奈川区反町1-8-14', 'yamamoto', 'yusuke'),
(4, '海野 弘成', '千葉県柏市末広町10-1', 'umino', 'yaotti'),
(5, '奥 一穂', '埼玉県さいたま市大宮区宮町4-13-2', 'oku', 'Kazuho_Oku'),
(6, 'まつもとひろゆき', '千葉県習志野市津田沼1-1-1', 'matsumoto', 'yukihiro_matz'),
(7, '岡野 真也', '長野県長野市鶴賀呑沢614-3', 'okano', 'tokibito'),
(8, '玉川 憲', '北海道札幌市北区北6条西8', 'tamagawa', 'KenTamagawa'),
(9, '松村 太朗', '木県宇都宮市東宿郷2-5-4', 'matsumura', 'taromatsumura');