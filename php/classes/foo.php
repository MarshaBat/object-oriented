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



	/**
	 * Accessor method for authorId
	 * @return int value of authorId
	 */

	public function getAuthorId() {
		return($this->getAuthorId);
	}
	/**
	 * Mutator method for authorId allows author to set a new Id for author.
	 *
	 * @param int $newAuthorId value for author Id
	 * @throws UnexpectedValueException if $newAuthorId is not an interger.
	 */

	public function setAuthorId($newAuthorId) {
		//verify the authorId is valid
		$newAuthorId = filter_var($newAuthorId, FILTER_VALIDATE_INT);
		if($newAuthorId === false) {
			throw(new UnexpectedValueException("author ID is not a valid integer"));
		}
		//convert and store the author id
		$this->authorId = intval($newAuthorId);

	}

	/**
	 * Accessor method for avatarUrl
	 */
}

	/**
	 * Accessor method for authorActivationToken
	 */

	/**
	 * Accessor method for authorEmail
	 */

	/**
	 * Accessor method for authorHash
	 * @return string value of author hash
	 **/
	public function getAuthorHash(): string {
		return $this->authorHash;
		}

	/**
	 * Mutator method for author hash allows author another hash
	 *
	 * @param string is a new author hash value for authorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/

	public function setAuthorHash (string $newAuthorHash): void {
		//enforces that the author hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author password hash is empty or insecure"));
		}
		//enforces that the hash is an Argon hash
		$authorHashInfo = password_get_info($newAuthorHash);
		if($authorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}
		//enforces that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("profile hash must be 97 characters"));
		}
		//stores the hash
		$this->authorHash = $newAuthorHash;
};


	/**
	 * Accessor method for authorUsername
	 */
?>