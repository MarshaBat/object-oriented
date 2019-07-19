<?php
namespace Mbattee\ObjectOriented;

use Ramsey\Uuid\Uuid;
// at 14 min mark in constructor video

//load the author class
require_once ("../classes/foo.php");

//use the constructor to create a new author
$author = new Author('e4bb089c-825b-416e-be9a-5948390ac564', 'http://go.com', '11111111112222222222333333333344', 'marsha@sanesuite.com', '0082a27021a4f84a85374b808e4ed057ee4d05b40767ebc151a3624a8b1ee740a1bdb1f2db09a51f28e95e125e21ac4984ce19a9c63120f9da10f7729e19bfb60c4c52fe5065a9e25d301fbafb79fa0dcb77e98e747296cdf9a87dd39812d832db', 'blkjlksdf');

var_dump($author);

?>

