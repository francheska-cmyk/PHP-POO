CREATE TABLE IF NOT EXISTS article(
	id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL UNIQUE,
    content TEXT,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    edited_at DATETIME,
    user_id INT NOT NULL,
    CONSTRAINT fk_article_user FOREIGN KEY (user_id) REFERENCES `user`(id) ON DELETE CASCADE
)ENGINE=innoDB;

INSERT INTO article (title,content,user_id)
	VALUES("Une Pas de Plus","Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi odio neque quos architecto est itaque! Officiis temporibus aliquam soluta at.",2),
		("Vers la Gloire","Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi odio neque quos architecto est itaque! Officiis temporibus aliquam soluta at.",2);