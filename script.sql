CREATE DATABASE IF NOT EXISTS mvc CHARSET utf8mb4;

USE mvc;

CREATE TABLE IF NOT EXISTS `role`(
	id INT PRIMARY KEY AUTO_INCREMENT,
	`role` VARCHAR(20) NOT NULL UNIQUE
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS `user`(
	id INT PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    role_id INT NOT NULL DEFAULT 2,
	CONSTRAINT fk_user_role FOREIGN KEY (role_id) REFERENCES `role`(id)
)ENGINE=innoDB;

INSERT INTO `role`(`role`) VALUES ('Administrateur'),('Client');

INSERT INTO `user`(pseudo, email, `password`, role_id)
	VALUES ('root', 'root@root.rt', '$2y$12$KTqrz1kdNrgpDvIzYHCrmuCi5WbNSpdOha7gUlFBpIjBq/euCa9N.', 1);
    
INSERT INTO `user`(pseudo, email, `password`)
	VALUES ('yoann', 'yoann@gmail.fr', '$2y$12$fTUdpZ2zZO7udEneY5PbM.NF7xWSAqxyeuPUqtG7BnIET120SjxI2');
    
