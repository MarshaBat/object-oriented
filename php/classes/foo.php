<?php
namespace Mbattee\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Author Table Class
 *
 * This author profile is an abbreviated example of the data collected and stored about an author.
 *	This information can be extended to included additional information about the author.
 *
 * @author Marsha Battee <marsha@sanesuite.com>
 **/

class	Author implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * This is an ID for the author's profile. This is the PRIMARY KEY and a NUMERIC VALUE.
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * A website link for a personal page for the author of this profile.
	 * @var string $authorAvatarUrl
	 **/
	private $authorAvatarUrl;
	/**
	 * Token give to verify that the profile is valid and not malicious.
	 * @var string $authorActivationToken
	 **/
	private $authorActivationToken;
	/**
	 * Email for this profile. This is a unique index.
	 * @var string $authorEmail
	 **/
	private $authorEmail;
	/**
	 * Hash for profile password.
	 * @var string $authorHash
	 **/
	private $authorHash;
	/**
	 * This is the author's username.
	 * @var string $authorUsername
	 **/
	private $authorUsername;


	/**
	 * Constructor for this Author class
	 *
	 * @param string|Uuid $newAuthorId is the id of this author profile or null if a new author profile
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

	public function __construct($newAuthorId, $newAuthorAvatarUrl, $newAuthorActivationToken, $newAuthorEmail, $newAuthorHash,
										 $newAuthorUsername) {
		try {
				$this->setAuthorId($newAuthorId);
				$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
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


	/**
	 * Accessor method for authorId
	 *
	 * @return Uuid value of authorId
	 **/

	public function getAuthorId() : Uuid {
		return($this->authorId);
	}

	/**
	 * Mutator method for authorId allows author to set a new Id for author
	 *
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 **/

	public function setAuthorId($newAuthorId) : void {
		//verify the authorId is valid
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the Author id
		$this->authorId = $uuid;
	}

	/**
	 * Accessor method for author avatar url
	 * @return string value of the author avatar url
	 *
	 **/

	public function getAuthorAvatarUrl() : string {
		return($this->authorAvatarUrl);
	}

	/**
	 * Mutator method for authorAvatarUrl
	 *
	 * @param string $newAuthorAvatarUrl new value of author avatar url
	 * @throws \RangeException if the author avatar url is greater than 255 characters
	 * @throws \InvalidArgumentException  if the author avatar url is not a string or insecure
	 **/

	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {

		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		//filter_flag???
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//verify that new avatar url will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("content is too large"));
		}
		//store the author avatar url
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/**
	 * Accessor method for author account activation token
	 *
	 * @return string value for authorActivationToken
	 **/

	public function getAuthorActivationToken() : string {
		return($this->authorActivationToken);
	}

	/**
	 * Mutator  method for author account activation token
	 * @param string $newAuthorActivationToken for author account activation token
	 * @throws \InvalidArgumentException if the token is not a string or is not secure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if $newAuthorActivationToken is not a string
	 **/

	public function setAuthorActivationToken($newAuthorActivationToken) {
		if($newAuthorActivationToken === null) {
			$this->AuthorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation token is not valid"));
		}
		//enforces author activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/**
	 * Accessor method for authorEmail, this is a UNIQUE ID and INDEX
	 **/

	public function getAuthorEmail() {
		return ($this->authorEmail);
	}

	/**
	 * Mutator method for authorEmail
	 *
	 * @param string $newAuthorEmail is the new value for author email
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a valid email or insecure
	 * @throws \RangeException if $newAuthorEmail is > 128 characters
	 * @throws \TypeError if $newAuthorEmail is not a string
	 **/

	public function setAuthorEmail($newAuthorEmail) : string { //placed "string" outside of argument??
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
		return $this->authorEmail = $newAuthorEmail;
		//return; May need to delete this line->"return;"??
	}

	/**
	 * Accessor method for authorHash
	 *
	 * @return string value for author hash
	 **/
	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	/**
	 * Mutator method for author hash allows the author another hash
	 *
	 * @param string is a new author hash value for authorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if author hash is not a string
	 **/

	public function setAuthorHash(string $newAuthorHash) : void { //placed "string" outside of argument
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
			throw(new \RangeException("author hash must be 97 characters"));
		}
		//stores the hash
		$this->authorHash = $newAuthorHash;
	}

	/**
	 * Accessor method for authorUsername
	 *
	 * @return string value for author username
	 */
	public function getAuthorUsername() : string {
		return ($this->authorUsername);
	}

	/**
	 * Mutator method for authorUsername, this is UNIQUE
	 *
	 * @param string $newAuthorUsername is the new value for author username
	 * @throws \InvalidArgumentException if $newAuthorUsername is not a string
	 * @return $newAuthorUsername
	 **/

	public function setAuthorUsername($newAuthorUsername) : string {
		//verifies that first name is valid
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING);
		if($newAuthorUsername === false) {
			throw(new \InvalidArgumentException("first name is not a valid string"));
		}

		//store and save the new author username
		return $this->authorUsername = $newAuthorUsername;
		//return; may need to delete
	}

	/**
	 * Inserts this author information into MySQL
	 *
 	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
 	**/

	public function insert (\PDO $pdo) : void {

		//This creates a query template.
		$query = "INSERT INTO author(authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername) VALUES (:authorId, :authorAvatarUrl, :authorActivationToken, :authorEmail, :authorHash, :authoUsername)";
		$statement = $pdo->prepare($query);

		//binds the member variables to the place holder in the template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorActivationToken, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * Deletes this author information from MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete (\PDO $pdo) : void {
		//This creates a query template.
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		//binds the member variables to the place holder in the template
		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);

	}

	/**
	 * Updates this Author in MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function update (\PDO $pdo) : void {
		//This creates a query template.
		$query = "UPDATE author SET authorAvatarUrl = :authorAvatarUrl, authorActivationToken = :authorActivationToken, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(),"authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorActivationToken, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * gets the Author by authorId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorId author id to search for
	 * @return Author|null Author found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/

	public static function getAuthorByAuthorId(\PDO $pdo, $authorId) : ?Author {
		// sanitize the authorId before searching
		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);
		// bind the author id to the place holder in the template
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		// grab the author from mySQL
		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
			}
		} catch(\Exception $exception) {

			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($author);
	}

	/**
	 * Gets all Authors
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Authors found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllAuthors(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of authors
		$authors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
				$authors[$authors->key()] = $author;
				$authors->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($authors);
	}



	/**
	 * toString() magic method
	 *
	 * @return string HTML of the formatted new author
	 */

	public function __toString() {
		//create an HTML formatted author class
		$html = "<p>Author Id: " 				 	. $this->authorId						. "<br />"
				.	"Author Avatar Url: "		 	. $this->authorAvatarUrl			. "<br />"
				.	"Author Activation Token: "	. $this->authorActivationToken	. "<br />"
				.	"Author Email: "					. $this->authorEmail					. "<br />"
				.	"Password Hash: "					. $this->authorHash					. "<br />"
				.	"Author Username: "				. $this->authorUsername
				.	"</p>";
		return($html);
		}


	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);
		$fields["authorId"] = $this->authorId;

		return($fields);
	}
}
?>

