DROP DATABASE IF EXISTS heroku_0786dd9b80b10d8;
CREATE DATABASE heroku_0786dd9b80b10d8;
USE heroku_0786dd9b80b10d8;

CREATE TABLE user (
	email VARCHAR(256) NOT NULL PRIMARY KEY,
    pass VARCHAR(64) NOT NULL,
    name VARCHAR(64) NOT NULL
);

CREATE TABLE comments (
	userName VARCHAR(64) NOT NULL PRIMARY KEY,
    commentPost VARCHAR(256) NOT NULL
);

INSERT INTO user 
	(email, pass, name)
	VALUES('colegilmore@u.boisestate.edu', 'admin', 'cole');
    
INSERT INTO comments
	(userName, commentPost)
    VALUES('colegilmore@u.boisestate.edu', 'This is the first comment!');
    
SELECT * FROM user;
SELECT * FROM comments;