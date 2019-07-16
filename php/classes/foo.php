<?php
/**
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
 */

/**
 * Author Table Class.
 *
 * This author profile is an abbreviated example of the data collected and stored about a author.
 *	This information can be extended to included additioonal information about the author.
 *
 * @author Marsha Battee <marsha@sanesuite.com>
 **/

class	Author {
	/**
	 *ID for this profile. This is the primary key.
	 */
	private $authorId;
	/**
	 *Website link for the author of this profile.
	 */
	private $AvatarUrl;
	/**
	 *Token give to verify that the profile is valid and not malicious.
	 */
	private $authorActivationToken;
	/**
	 *Email for this profile. This is a unique index.
	 */
	private	$authorEmail;
	/**
	Has for profile password.
	 */
	private $authorHash;
	/**
	 *This is the author's username.
	 */
	private $authorUsername;

}
?>