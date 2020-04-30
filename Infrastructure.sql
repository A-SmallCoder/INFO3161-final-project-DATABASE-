/* ~~FMoney Enterprise~~ */

create table user(
    user_id int not null auto_increment,
    password_hash binary(64) not null,
    email varchar(40) not null,
    firstname varchar(35) not null,
    lastname varchar(35) not null,
    date_of_birth date not null,
    primary key(user_id)
);

create table phone(
    user_id int,
    phone_number int(10),
    primary key(user_id),
    foreign key(user_id) references user(user_id) on delete cascade
);

create table image(
    image_id int auto_increment,
    image_data mediumblob not null,
    primary key(image_id)
);

create table post(
    post_id int auto_increment,
    image_id int,
    user_id int,
    post_body text,
    primary key(post_id),
    foreign key(image_id) references image(image_id) on delete cascade,
    foreign key(user_id) references user(user_id) on delete cascade
);

create table profile(
    profile_id int not null auto_increment,
    user_id int,
    post_id int,
    image_id int,
    date_created date,
    primary key(profile_id),
    foreign key(user_id) references user(user_id) on delete cascade,
    foreign key(post_id) references post(post_id) on delete cascade,
    foreign key(image_id) references image(image_id) on delete cascade
);
/*trigger to create a profile when a user is added*/
Delimiter $$
CREATE TRIGGER profile_trigger
AFTER insert ON user
FOR EACH ROW
BEGIN
insert into profile(user_id,date_created) values
(new.user_id,curdate());
END $$
delimiter ;


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