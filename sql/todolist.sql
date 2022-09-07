CREATE TABLE users(
   id_users INT NOT NULL AUTO_INCREMENT,
   pseudonyme VARCHAR(50) NOT NULL,
   password VARCHAR(50) NOT NULL,
   PRIMARY KEY (id_users)
);

CREATE TABLE tasks(
   id_tasks INT NOT NULL AUTO_INCREMENT,
   description VARCHAR(255) NOT NULL,
   is_done BOOLEAN NOT NULL,
   color VARCHAR(50) NOT NULL,
   date_task DATE NOT NULL,
   priority INT NOT NULL,
   id_users INT NOT NULL,
   PRIMARY KEY (id_tasks),
   FOREIGN KEY (id_users) REFERENCES users(id_users)
);

CREATE TABLE themes(
   id_themes INT NOT NULL AUTO_INCREMENT,
   name_theme VARCHAR(50) NOT NULL,
   PRIMARY KEY (id_themes)
);

CREATE TABLE have(
   id_tasks INT NOT NULL,
   id_themes INT NOT NULL,
   PRIMARY KEY (id_tasks, id_themes),
   FOREIGN KEY (id_tasks) REFERENCES tasks(id_tasks),
   FOREIGN KEY (id_themes) REFERENCES themes(id_themes)
);

CREATE TABLE share(
   id_users INT NOT NULL,
   id_tasks INT NOT NULL,
   PRIMARY KEY (id_users, id_tasks),
   FOREIGN KEY (id_users) REFERENCES users(id_users),
   FOREIGN KEY (id_tasks) REFERENCES tasks(id_tasks)
);
