/*CREATE DATABASE guestbook
CHARACTER SET utf8
COLLATE utf8_general_ci;*/

DROP TABLE IF EXISTS `admin`;

create table `admin`
(
	id int auto_increment,
	username varchar(150) not null,
	email varchar(150) not null,
	password varchar(120) not null,
	created_at timestamp null,
	updated_at timestamp null ON UPDATE CURRENT_TIMESTAMP,
	constraint admin_pk
		primary key (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

create unique index admin_email_uindex
	on admin (email);

create unique index admin_username_uindex
	on admin (username);

DROP TABLE IF EXISTS `visitor_message`;

create table `visitor_message`
(
	id int auto_increment,
	message text not null,
	visitor_name varchar(250) not null,
	created_at timestamp null,
	updated_at timestamp null ON UPDATE CURRENT_TIMESTAMP,
	constraint message_pk
		primary key (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

insert into admin (username, email, password) values ('admin', 'admin@local.com', md5('123456'))