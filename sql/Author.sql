-- The statement below sets the collation of the database to utf8
ALTER DATABASE mbattee CHARACTER SET utf8_unicode_ci;

-- These statements drop the following tables if they exists.
DROP TABLE IF EXISTS author;

-- These tables will create the table "task".

create table author(
	authorId binary(16) not null,
	authorAvatarUrl varchar(255),
	authorActivationToken char(32),
	authorEmail varchar(128) not null,
	authorHash char(97) not null,
	authorUsername varchar(32) not null,
	unique(authorEmail),
	unique(authorUsername),
	INDEX(authorEmail),
	primary key(authorId)
);