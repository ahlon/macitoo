-- create database macitoo DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; 
-- table create template
CREATE TABLE `xxx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_time` datetime NOT NULL,
  `last_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

﻿use macitoo;

-- 用户�?
create table users (
    id int auto_increment,
    email varchar(30) NOT NULL,
    display_name varchar(20) NOT NULL,
    password varchar(40) NOT NULL,
    gender varchar(10),
    city varchar(20),
    status varchar(20),
    created_time timestamp not null default current_timestamp,
    last_updated_time timestamp null,
	reset_token varchar(40) NULL,
	reset_time timestamp null,
    UNIQUE (email),
    primary key(id)
) engine=InnoDB default charset=utf8;

-- 用户设置
create table user_settings (
    user_id int comment '用户id',
    calendar_url varchar(100) comment '外部日历地址',
    primary key(user_id)
) engine=InnoDB default charset=utf8;

create table goals (
    id int auto_increment,
    name varchar(50) not null comment '目标概述',
	goal_type_id int comment '目标类型',
    user_id int comment '用户id',
    started_on timestamp,
    ended_on timestamp,
    status varchar(20),
    created_time timestamp,
    last_updated_time timestamp,
    primary key(id)
) engine=InnoDB default charset=utf8;


create table activities (
    id int auto_increment,
    user_id int comment '用户id',
    goal_id int comment '目标id',
    day date comment '日期',
    status varchar(20),
    created_time timestamp not null default current_timestamp comment '创建时间',
    primary key(id)
) engine=InnoDB default charset=utf8;

create table segments (
    id int auto_increment,
    text varchar(200),
    created_time timestamp not null default current_timestamp comment '创建时间',
    user_id int comment '用户id',
    primary key(id)
) engine=InnoDB default charset=utf8;

-- ----------------------------
-- Table structure for `rd_tasks`
-- ----------------------------
DROP TABLE IF EXISTS `rd_tasks`;
CREATE TABLE `rd_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `review` text,
  `created_time` datetime NOT NULL,
  `last_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `rd_task_timer_rels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `timer_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `last_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2013-04-02 23:00 added by ahlon
CREATE TABLE `acl_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(64) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_uri` (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cr_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2013-04-04 18:30 added by ahlon
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `title` varchar(400) NOT NULL,
  `snapshot_img_id` int(11) DEFAULT NULL,
  `summary` varchar(400) DEFAULT NULL,
  `content` mediumtext,
  `creator_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `last_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2013-04-04 18:30 added by ahlon
CREATE TABLE `mottos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(200) NOT NULL,
  `created_time` datetime NOT NULL,
  `last_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2013-04-16 16:30 added by ahlon
create view `v_categories` as 
select tt.*, t.name from cr_term_taxonomy tt join cr_terms t on t.id = tt.term_id;

-- 2013-04-16 23:00 added by ahlon
CREATE TABLE `user_douban_pages` (
  `user_id` int(11) NOT NULL,
  `reading_status` varchar(20) NOT NULL,
  `pages` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table `cr_books` add column douban_id int;


-- 2013-04-19 0:18 added by Robin
CREATE TABLE `project_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record` text,
  `created_time` datetime NOT NULL,
  `last_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
