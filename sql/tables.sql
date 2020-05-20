Drop database IF EXISTS DBPROJECT;

Create database DBPROJECT;

use DBPROJECT;

create table user(id int auto_increment, Fname varchar(20), lname varchar(20),
 email varchar(100),`password` varchar(255),
 street varchar(100),city varchar(100),
 country varchar(50), DOB date, primary key(id));

 create table user_profile(profile_id int auto_increment, username varchar(50),Bio varchar(200),
primary key(profile_id));

create table `group`(group_id int auto_increment, group_name varchar(50), primary key(group_id));

create table posts(post_id int auto_increment, post_date timestamp,
 post_text varchar(500), post_image varchar(255), primary key(post_id));
 
create table phone(`userID` int, `phoneNumber` char(12),
 primary key(`userID`,`phoneNumber`),
foreign key(`userID`) references user(id) on update cascade on delete cascade);

 create table friend(user_id int,
   friend_id int,
   friend_type enum('Relative','School','work'),
   primary key(user_id,friend_id),
   foreign key(user_id) references User(id) on update cascade on delete cascade,
   foreign key(friend_id) references User(id) on update cascade on delete cascade
   );


create table created_on(date_created timestamp, profile_id int, user_id int,
primary key(user_id,profile_id),
foreign key(user_id) references User(id) on update cascade on delete cascade,
foreign key(profile_id) references user_profile(profile_id) on update cascade on delete cascade);



create table comment(cid int, comment_text varchar(500),user_id int,post_id int,comment_time timestamp,
primary key(user_id,cid,post_id),
foreign key(user_id) references user(id) on update cascade on delete cascade,
foreign key(post_id) references posts(post_id) on update cascade on delete cascade);

create table make_post(user_id int, post_id int, post_date timestamp,
primary key(post_id,user_id),
foreign key(user_id) references User(id) on update cascade on delete cascade,
foreign key(post_id) references posts(post_id) on update cascade on delete cascade);


create table member_of(user_id int, group_id int,editor boolean,
primary key(user_id,group_id),
foreign key(user_id) references user(id) on update cascade on delete cascade,
foreign key(group_id) references `group`(group_id) on update cascade on delete cascade);

create table Images(Photo_id int auto_increment, profile_id int, image_path varchar(255),
primary key(Photo_id,profile_id), foreign key(profile_id) references user_profile(profile_id) on update cascade on delete cascade);

create table post_contains(Photo_id int,profile_id int,post_id int, post_date date, 
primary key(photo_id,profile_id,post_id), foreign key(photo_id) references Images(Photo_id) on update cascade on delete cascade, foreign key(profile_id) references user_profile(profile_id) on update cascade on delete cascade,
foreign key(post_id) references posts(post_id) on update cascade on delete cascade);

create table post_text(post_id int,post_text_id int, post_text text, primary key(post_id,post_text_id),
foreign key (post_id) references posts(post_id) on update cascade on delete cascade);

create table post_image(post_id int, photo_id int,primary key(post_id,photo_id), foreign key (photo_id) references Images(Photo_id) on update cascade on delete cascade, foreign key (post_id) references posts(post_id) on update cascade on delete cascade);

create table make_group(group_id int not null,user_id int not null, creation_date date, primary key(group_id,user_id),
foreign key(group_id) references `group`(group_id) on update cascade on delete cascade,
foreign key(user_id) references user(id) on update cascade on delete cascade);

create table group_post(post_id int, group_id int, post_date timestamp, primary key(post_id,group_id),
foreign key(post_id) references posts(post_id), foreign key(group_id) references `group`(group_id));