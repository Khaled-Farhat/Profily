CREATE TABLE `profily`.`users`(
   id INT NOT NULL AUTO_INCREMENT,
   username VARCHAR(32) NOT NULL,
   password TEXT NOT NULL,
   user_type TEXT NOT NULL,
   updated_at TIMESTAMP,
   created_at TIMESTAMP,
   PRIMARY KEY (id),
   UNIQUE KEY (username)
) CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE `profily`.`posts`(
   id INT NOT NULL AUTO_INCREMENT,
   user_id INT NOT NULL,
   title TEXT NOT NULL,
   content TEXT,
   updated_at TIMESTAMP,
   created_at TIMESTAMP,
   PRIMARY KEY (id)
) CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE `profily`.`comments`(
   id INT NOT NULL AUTO_INCREMENT,
   user_id INT NOT NULL,
   post_id INT NOT NULL,
   content TEXT,
   updated_at TIMESTAMP,
   created_at TIMESTAMP,
   PRIMARY KEY (id)
) CHARSET = utf8 COLLATE = utf8_unicode_ci;
