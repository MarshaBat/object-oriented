<?php
namespace Mbattee\ObjectOriented;

use Ramsey\Uuid\Uuid;


//load the author class
require_once ("../classes/foo.php");

//use the constructor to create a new author
$author = new Author('e4bb089c-825b-416e-be9a-5948390ac564', 'http://go.com', '11111111112222222222333333333344', 'marsha@sanesuite.com', '$argon2i$v=19$m=1024,t=384,p=2$dE55dm5kRm9DTEYxNFlFUA$nNEMItrDUtwnDhZ41nwVm7ncBLrJzjh5mGIjj8RlzVA', 'blkjlksdf');

var_dump($author);





public function insert (\PDO $pdo) : void {

	//This creates a query template.
	$query = "INSERT INTO Author (authorAvatarUrl, authorEmail, authorUsername) VALUES (:authorAvatarUrl, :authorEmail, :authorUsername)";
		$statement = $pdo->prepare($query);

}


?>

