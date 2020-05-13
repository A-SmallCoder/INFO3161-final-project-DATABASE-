
LOAD DATA INFILE 'db_data2.csv' 
INTO TABLE user 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(Fname,lname,email,`password`,street,city,country,DOB);


LOAD DATA INFILE 'telephone.csv' 
INTO TABLE phone 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'friends.csv' 
INTO TABLE friend 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'profile.csv' 
INTO TABLE user_profile 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

