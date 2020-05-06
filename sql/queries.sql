/*trigger to create a profile when a user is added*/
Delimiter $$
CREATE TRIGGER profile_trigger
AFTER insert ON user
FOR EACH ROW
BEGIN
insert into profile(user_id,date_created) values
(new.user_id,curdate());
END $$
delimiter;

/*trigger to link post to a profile when it is made*/
Delimiter $$
CREATE TRIGGER post_trigger
AFTER insert ON profile
FOR EACH ROW
BEGIN
insert into profile(user_id,post_id,post_date) values
(new.user_id,new.post_id,now());
END $$
delimiter;
