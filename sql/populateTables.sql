
Insert into user(Fname,lname,email,username,`password`,street,city,country,DOB)
values ("Derwent","Johnson","derwentj@gmail.com","derwentj","jhFV;P79EWIIFEWVUUWEDKJSMBD,","21 Main street","Kingston","Jamaica",1996-01-06),
("John","Paul","john.paul@yahoo.com","PaulJohn","jvinnkabbkkdnvwfhabwlaurfnhrvdn","34 East Street","Miami","USA",1990-10-21),
("Natalie","Williams","natalie1234@live.com","natalie1234","liuasgwbwfbkleghyuwhefgufbewvui","2 West Ave","Philadelphia","USA",1999-06-25),
("Nicholas","McKenzie","NMckenzie24@gmail.com","NMckenzie24","bfewuiwgnerwgoi4nfwi2ofnw","59 East Street","Miami","USA",1989-02-15);

Insert into phone(`userID`, `phoneNumber`) values (1,"876-532-9238"),(2,"256-265-2648"),(3,"465-235-0686"),(4,"235-995-4526");
Insert into friend(user_id,friend_id,friend_type) values (1,2,"Relative"),(1,3,"Work"),(2,4,"School");

LOAD DATA INFILE 'db_data2.csv' 
INTO TABLE user 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(Fname,lname,email,username,`password`,street,city,country,DOB);


LOAD DATA INFILE 'telephone.csv' 
INTO TABLE phone 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(`userID`,`phoneNumber`);

LOAD DATA INFILE 'friends.csv' 
INTO TABLE friend 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(user_id,friend_id,friend_type);

-- LOAD DATA INFILE 'profile.csv' 
-- INTO TABLE user_profile 
-- FIELDS TERMINATED BY ',' 
-- ENCLOSED BY '"'
-- LINES TERMINATED BY '\n'
-- IGNORE 1 ROWS;
-- (username)


