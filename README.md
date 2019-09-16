### website used as rest api for mappers application

**TO CLONE AND RUN YOU MUST FULFILL THOSE REQUIREMENTS FIRST**  
1. php must be included in the environment path  
2. git must be installed and reachable from cmd  
3. make sure that mode_rewrite enabled in your apache config  
4. open txt file and past this code  

```
git clone https://github.com/arafeh94/GraphViewer.git
cd GraphViewer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php composer.phar install
```
**OPEN MYSQL DATABASE AND CREATE TABLE matlab, THEN USE THE SCRIPT BELOW TO CREATE THE TABLES**  
```mysql
create table author
(
	id int auto_increment
		primary key,
	name varchar(255) null,
	address varchar(255) null
);

create table graph
(
	id int auto_increment
		primary key,
	title varchar(255) null,
	description varchar(255) null,
	mfile varchar(255) null,
	default_input text null,
	project_id int null,
	created_by int null,
	created_at timestamp default CURRENT_TIMESTAMP null
);

create index created_by
	on graph (created_by);

create index project_id
	on graph (project_id);

create table project
(
	id int auto_increment
		primary key,
	title varchar(255) null,
	description text null,
	publishers_url text null,
	download_url text null,
	youtube_id text null,
	created_by int null,
	created_at timestamp default CURRENT_TIMESTAMP null
);

create index created_by
	on project (created_by);

create table project_authors
(
	id int auto_increment
		primary key,
	project_id int null,
	author_id int null
);

create index project_authors_author_id_fk
	on project_authors (author_id);

create index project_authors_project_id_fk
	on project_authors (project_id);

create table user
(
	id int auto_increment
		primary key,
	username varchar(255) null,
	password varchar(255) null,
	role tinyint null,
	created_at timestamp default CURRENT_TIMESTAMP null,
	constraint username
		unique (username)
);
# create user if required
INSERT INTO `author` (`id`, `name`, `address`) VALUES (NULL, 'none', 'default author');
INSERT INTO `user` (`id`, `username`, `password`, `role`, `created_at`) VALUES (NULL, 'admin', 'admin', '1', CURRENT_TIMESTAMP);
```

