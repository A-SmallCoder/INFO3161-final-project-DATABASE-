/* ~~FMoney Enterprise~~ */

-- Drop database IF EXISTS DBPROJECT;

-- Create database DBPROJECT;

-- use DBPROJECT;

create table User(id int, Fname varchar(20), lname varchar(20),
 email varchar(100),
 username varchar(30),`password` varchar(255),
 street varchar(100),city varchar(100),
 country varchar(50), DOB date, primary key(id));

 create table user_profile(profile_id int auto_increment, profile_pic varchar(250),
primary key(profile_id));

create table `group`(group_id int auto_increment, group_name varchar(50), primary key(group_id));

create table posts(post_id int auto_increment, post_date timestamp,
 post_text varchar(500), post_image varchar(255), primary key(post_id));
 
create table phone(`userID` int, `phoneNumber` char(12),
 primary key(`userID`,`phoneNumber`),
foreign key(`userID`) references user(id));

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



create table comment(cid int, comment_text varchar(500),user_id int,post_id int,
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

-- create table image(
--     image_id int auto_increment,
--     image_data mediumblob not null,
--     primary key(image_id)
-- );



-- create table profile(
--     profile_id int not null auto_increment,
--     user_id int,
--     post_id int,
--     image_id int,
--     date_created date,
--     primary key(profile_id),
--     foreign key(user_id) references user(user_id) on delete cascade,
--     foreign key(post_id) references post(post_id) on delete cascade,
--     foreign key(image_id) references image(image_id) on delete cascade
-- );

/* this gives an error at the moment
create table group(
    group_id int auto_increment,
    name varchar(30) not null,
    user_id int,
    editor boolean,
    primary key(group_id),
    foreign key(user_id) references user(user_id) on delete cascade
);
*/