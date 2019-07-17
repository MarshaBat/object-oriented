<?php

/**
 * Author Table Class
 *
 * DONE authorId binary(16) not null,
 * NOT DONE authorAvatarUrl varchar(255),			****CHECK VOIDS and STRINGS in functions****
 * DONE authorActivationToken char(32),
 * DONE authorEmail varchar(128) not null,
 * DONE authorHash char(97) not null,
 * DONE authorUsername varchar(32) not null,


 * This author profile is an abbreviated example of the data collected and stored about a author.
 *	This information can be extended to included additional information about the author.
 *
 * @author Marsha Battee <marsha@sanesuite.com>
 **/

class	Author {

	//:::::::::::::::::START OF STATE VARIABLES:::::::::::::::::
	/**
	 *This ia an ID for the author's profile. This is the primary key and a numeric value.
	 */
	private $authorId;
	/**
	 *A website link for a personal page for the author of this profile.
	 */
	private $avatarUrl;
	/**
	 *Token give to verify that the profile is valid and not malicious.
	 */
	private $authorActivationToken;
	/**
	 *Email for this profile. This is a unique index.
	 */
	private $authorEmail;
	/**
	 * Hash for profile password.
	 */
	private $authorHash;
	/**
	 *This is the author's username.
	 */
	private $authorUsername;

	//::::::::::::::::END OF STATE VARIABLES::::::::::::::::::::

	//::::::::::::::::BEGIN CONSTRUCTOR::::::::::::::::::::::::

	/**
	 * Constructor for this Author class
	 *
	 * @param string $newAuthorId is the id of this author profile or null if a new author profile
	 * @param string $newArthurUrl is a string containing the new author url
	 * @param string $newAuthorActivationToken is the activation token to safeguard against malicious accounts
	 * @param string $newAuthorEmail is a string containing an email for the author
	 * @param string $newAuthorHash string containing password hash
	 * @param string $newAuthorUsername is a string containing the new author username
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct($newAuthorId, $newAuthorUrl, $newAuthorActivationToken, $newAuthorEmail, $newAuthorHash,
										 $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAvatarUrl($newAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} catch(\InvalidArgumentException | \RangeException | \TypeError $exception) {
			//To determine what type of exception was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	//:::::::::::::::::END CONSTRUCTOR::::::::::::::::::::::::::

	//::::::::::::::::BEGIN METHODS:::::::::::::::::::::::::::::

	/**
	 * Accessor method for authorId
	 * @return int value of authorId
	 */

	public function getAuthorId() {
		return ($this->authorId);
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
	 *
	 **/

	public function getAvatarUrl() : string {
		return($this->avatarUrl);
	}

	public function setAvatarUrl($newAvatarUrl) {
		if($newAvatarUrl === ) {
			$this->AvatarUrl = ;
			*****
			MISSING INFORMATION ****
		}
	}


	/**
	 * Accessor method for author account activation token
	 *
	 * @return string value for authorActivationToken
	 */

	public function getAuthorActivationToken() : string {
		return($this->authorActivationToken);
	}

	/**
	 * Mutator  method for author account activation token
	 * @param string $newAuthorActivationToken for author account activation token
	 * @throws \InvalidArgumentException if the token is not a string or is not secure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError is $newAuthorActivationToken is not a string
	 */

	public function setAuthorActivationToken($newAuthorActivationToken) {
		if($newAuthorActivationToken === null) {
			$this->AuthorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation token is not valid"));
		}
		//enforces user activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/**
	 * Accessor method for authorEmail
	 */

	public function getAuthorEmail() {
		return ($this->authorEmail);
	}

	/**
	 * Mutator method for authorEmail
	 * @param string $newAuthorEmail is the new value for author email
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a valid email or insecure
	 * @throws \RangeException if $newAuthorEmail is > 128 characters
	 * @throws \TypeError if $newAuthorEmail is not a string
	 **/

	public function setAuthorEmail(string $newAuthorEmail) {
		// This verifies that the email address is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}
		// This verifies the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("author email length is too long"));
		}
		// store the email
		$this->authorEmail = $newAuthorEmail;
	}


	/**
	 * Accessor method for authorHash
	 * @return string value of author hash
	 **/
	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	/**
	 * Mutator method for author hash allows author another hash
	 *
	 * @param string is a new author hash value for authorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/

	public function setAuthorHash(string $newAuthorHash) {
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
	}


	/**
	 * Accessor method for authorUsername
	 *
	 * @return string value for author username
	 */
	public function getAuthorUsername() {
		return ($this->authorUsername);
	}

	/**
	 * Mutator method for authorUsername
	 * @param string $newAuthorUsername is the new value for author username
	 * @throws UnexpectedValueException if $newAuthorUsername is not a string
	 **/

	public function setAuthorUsername() {
		//verifies that first name is valid
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING);
		if($newAuthorUsername === false) {
			throw(new UnexpectedValueException("first name is not a valid string"));
		}

		//store and save the author username
		$this->authorUsername = $newAuthorUsername;

	}

	//::::::::::::::::END METHODS:::::::::::::::::::::::::::::

	//::::::::::::::::TO-STRING METHOD:::::::::::::::::::::::::::::
	/**
	 * toString() magic method
	 *
	 * @return string HTML of the formatted new author
	 */

	public function __toString() {
		//create an HTML formatted author
		$html = "<p>Author id: " 				 	. $this->authorId						. "<br />"
				.	"Avatar url: "  				 	. $this->avatarUrl					. "<br />"
				.	"Author activation token: "	. $this->authorActivationToken	. "<br />"
				.	"Author email: "					. $this->authorEmail					. "<br />"
				.	"Password hash: "					. $this->authorHash					. "<br />"
				.	"Author username: "				. $this->authorUsername
				.	"</p>";
		return($html);
		}
		//::::::::::::::::END TO-STRING METHOD:::::::::::::::::::::::::::::

	}


?>