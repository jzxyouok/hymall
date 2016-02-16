#创建商品类别表
create table it_type(
	type_id tinyint unsigned primary key auto_increment comment'商品类别编号',
	type_name varchar(32) not null comment'商品类别名称',
	index (type_name)
)charset utf8;
#创建商品属性表
create table it_attribute(
	attr_id smallint unsigned primary key auto_increment comment'商品属性编号',
	type_id  tinyint unsigned not null comment'商品类别编号',
	attr_name varchar(32) not null comment'属性的名称',
	attr_type tinyint not null default 0 comment'属性的类型，0表示唯一属性，1表示单选属性',
	attr_input_type tinyint not null default 0 comment'属性的录入方式，0表示手工录入，1表示列表选择',
	attr_value varchar(64) not null default '' comment'可选值列表',
	index (type_id)
)charset utf8;
#创建商品栏目表
create table it_category(
	cat_id smallint unsigned primary key auto_increment comment'商品栏目编号',
	cat_name varchar(32) not null comment'栏目的名称',
	parent_id smallint unsigned not null default 0 comment'栏目的父级栏目编号'
)charset utf8;
#创建商品表
create table it_goods(
	goods_id smallint unsigned primary key auto_increment comment'商品id编号',
	goods_name varchar(32) not null default'' comment'商品的名称',
	cat_id smallint unsigned not null default 0 comment'栏目编号',
	type_id smallint unsigned not null default 0 comment'商品所属类型编号',
	goods_sn varchar(32) not null default'' comment'商品的货号',
	shop_price decimal(9,2) not null default 0.0 comment'本店价格',
	market_price decimal(9,2) not null default 0.0 comment'市场价格',
	is_new tinyint unsigned not null default 0 comment'是否新品，0不是1是',
	is_hot tinyint unsigned not null default 0 comment'是否热卖，0不是1是',
	is_best tinyint unsigned not null default 0 comment'是否精品，0不是1是',
	is_sale tinyint unsigned not null default 1 comment'是否销售，0不是1是',
	is_delete tinyint unsigned not null default 0 comment'是否删除，0不是1是',
	goods_ori varchar(128) not null default'' comment'上传的原图路径',
	goods_img varchar(128) not null default'' comment'中图路径',
	goods_thumb varchar(128) not null default'' comment'小图路径',
	goods_desc text not null comment '商品描述',
	goods_number int not null default 0 comment'商品的库存',
	add_time int not null default 0 comment '添加时间'
)charset utf8;
#创建商品和商品属性关系表
create table it_goods_attr(
	id smallint unsigned primary key auto_increment comment '自增的编号',
	goods_id smallint unsigned not null comment '商品的编号',
	attr_id smallint unsigned not null comment '商品属性的编号',
	attr_value varchar(64) not null comment '属性值内容'
)charset utf8;
#创建相册表
create table it_goods_photo(
	id smallint unsigned primary key auto_increment comment '自增的编号',
	goods_id smallint unsigned not null comment '商品的编号',
	photo_ori varchar(128) not null default '' comment '相册原图路径',
	photo_thumb varchar(128) not null default '' comment '相册缩略图路径'
)charset utf8;
#创建权限表
create table it_privilege(
	priv_id smallint unsigned primary key auto_increment comment '权限的编号',
	priv_name varchar(32) not null default'' comment'权限的名称',
	parent_id smallint unsigned not null default 0 comment '父级权限的编号',
	module_name varchar(32) not null default '' comment '权限对应的模块名',
	controller_name varchar(32) not null default '' comment '权限对应的控制器名',
	action_name varchar(32) not null default '' comment '权限对应的方法名'
)charset utf8;
#创建角色表
create table it_role(
	role_id smallint unsigned primary key auto_increment comment '角色的编号',
	role_name varchar(32) not null default'' comment'角色的名称'
)charset utf8;
#创建角色权限关系表
create table it_role_privilege(
	role_id smallint unsigned comment '角色的编号',
	priv_id smallint unsigned comment '权限的编号'
)charset utf8;
#创建管理员表
create table it_admin(
	admin_id smallint unsigned primary key auto_increment comment '管理员的编号',
	admin_name varchar(32) not null comment '管理员的用户名',
	password char(32) not null comment '管理员密码',
	salt char(6) not null comment '密码密匙'
)charset utf8;
#插入超级管理员，密码为admin 密匙为erty12 生成密码的方式md5(md5('admin').'erty12')
#生成的密码是'b41290779a8cc57d9da2bb65026ce9ac'
insert into it_admin values(null,'admin','b41290779a8cc57d9da2bb65026ce9ac','erty12');
#建立管理员和角色间的关系表
create table it_admin_role(
	admin_id smallint unsigned not null comment '管理员的编号',
	role_id  smallint unsigned not null comment '角色的编号',
	index(admin_id),
	index(role_id)
)charset utf8;
#创建一个用户表
create table it_user(
	user_id int unsigned primary key auto_increment comment '用户的编号',
	username varchar(32) not null comment '用户名',
	password char(32) not null comment '用户密码',
	email varchar(32) not null comment '用户邮箱',
	validate varchar(32) not null default '' comment '密码的密匙',
	active tinyint not null default 0 comment '用户的状态，0表示未激活，1表示激活',
	question varchar(32) not null comment '设置问题，用于找回密码',
	answer varchar(32) not null comment '问题答案，用于找回密码'
)charset utf8;
#创建购物车的表
create table it_cart(
	goods_id mediumint unsigned not null comment '商品的编号',
	goods_attr_id varchar(32) not null default '' comment '商品属性的编号，it_goods_attr中的id',
	goods_count tinyint unsigned not null comment '购买的数量',
	user_id int unsigned not null comment '用户的编号'
)charset utf8;
#创建订单信息表
create table it_order_info(
	order_id int unsigned primary key auto_increment comment '订单表自增的编号',
	order_sn varchar(32) not null comment '订单号',
	goods_amount decimal(9,2) not null comment '订单的总金额',
	pay_status tinyint not null default 0 comment '支付状态，0表示未支付1表示已支付',
	user_id int not null comment '登陆用户的id',
	consignee varchar(32) not null comment '收货人',
	address varchar(64) not null comment '收货人地址',
	mobile bigint unsigned not null comment '收货人的手机',
	payment tinyint not null comment '支付方式',
	shipping tinyint not null comment '配送方式',
	addtime int not null comment '下单时间'
)charset utf8;
#创建一个订单商品关联表
create table it_order_goods(
	id int unsigned primary key auto_increment comment '自增的编号',
	order_id int unsigned not null comment '订单id',
	goods_id int unsigned not null comment '商品的id',
	goods_name varchar(32) not null comment '商品的名称',
	goods_attr_id varchar(32) not null comment '商品的属性',
	shop_price decimal(9,2) not null comment '商品的本店价格',
	goods_count smallint unsigned not null comment '购买数量'
)charset utf8;
#创建一个收货人信息表
create table it_address(
	id int unsigned primary key auto_increment comment '自增的编号',
	user_id int not null comment '登陆用户的id',
	consignee varchar(32) not null comment '收货人姓名',
	address varchar(64) not null comment '收货人地址',
	mobile bigint not null comment '收货人电话',
	post mediumint not null comment '邮编'
)charset utf8;
#创建货品库存表
create table it_product(
	goods_id int unsigned not null comment '商品的id',
	goods_attr_id varchar(32) not null comment '商品的属性,it_goods_attr表中的id属性多个逗号隔开',
	goods_number int not null default 0 comment'商品的库存'
)charset utf8;