-- Delimiter $$
-- Create Trigger After_friend_insert
-- Before Insert on friend
-- For Each Row
-- begin
-- DECLARE new_user1 int;
-- DECLARE new_user2 int;
-- set new_user1 := new.user_id;
-- set new_user2 := new.friend_id;
-- Insert into friend(user_id,friend_id,friend_type) values (new_user2,new_user1,new.friend_type,now());
-- end
-- $$


Delimiter $$
Create Procedure find_friend(userID int,friendID int)
begin
Select * from friend where (userID = friend.user_id and friendID = friend.friend_id) or 
(userID = friend.friend_id and friendID = friend.user_id);
end
$$

Delimiter $$
Create Procedure add_editor(userID,groupID)
begin
update member_of
set editor = true
where member_of.user_id = userID and member_of.group_id = groupID
end
$$

Delimiter $$
Create Procedure remove_editor(userID,groupID)
begin
update member_of
set editor = false
where member_of.user_id = userID and member_of.group_id = groupID
end
$$

Delimiter $$
create Trigger update_member_of
After Insert on make_group
for each row
begin
insert into member_of(user_id, group_id, editor) values(new.user_id,new.group_id, true);
end
$$

Delimiter $$
Create Procedure Create_group(userID int, groupID int, groupName varchar(50))
begin
insert into `group`()
-- insert into user(Fname,lname,email,password,street,city,country,DOB)
--     -> values('Derwent','Johnson','derwent@gmail.com','password','10 sunny ave','Kingston','Jamaica',
--     -> 1996-01-06),('Kim','Taylor','kimmyt@gmail.com','1234password','21 midnight rd','Kingston','Jamaica',1999-01-02);
-- Delimiter $$
-- Create Procedure insert_friend(new_user1 int,new_user2 int,friend_type enum('Relative','School','work'))
-- begin
-- Insert into friend(user_id,friend_id,friend_type) values (new_user2,new_user1,new.friend_type);
-- end
-- $$

-- insert into friend(user_id,friend_id,friend_type) values (1,2,'School');

-- delete from friend where user_id = 1;

