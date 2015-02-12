create table videos (
	id int auto_increment primary key,
    vname varchar(255) not null unique,
    category varchar(255),
    length int unsigned,
    rented boolean not null default true)engine=innodb;

-- 
-- id - an auto incrementing integer which is the primary key of each video.
-- name - the name of the video, this should be a variable length string with a maximum length of 255 characters. This is a required field and must be unique.
-- category - the category the video belongs to (action, comedy, drama etc), this should be a variable length string with a maximum length of 255 characters.
-- length - the length of the movie in minutes, recorded as a positive integer.
-- rented - this is a boolean value indicating if the video is checked in or not. It is a required field. When added it should default to checked in.