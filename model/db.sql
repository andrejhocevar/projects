drop table if exists user;

create table user(
   user_id INT NOT NULL AUTO_INCREMENT,
   user_name VARCHAR(10) NOT NULL,
   user_email VARCHAR(50) NOT NULL,
   user_password VARCHAR (200) NOT NULL,
   user_joined DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY ( user_id )
);

drop table if exists photo;

create table photo(
   photo_id INT NOT NULL AUTO_INCREMENT,
   author_id INT NOT NULL,
   photo_title VARCHAR (30) NOT NULL,
   photo_description VARCHAR (1000) NOT NULL,
   photo  VARCHAR(500) NOT NULL,
   upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (photo_id)
);