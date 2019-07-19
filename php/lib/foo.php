<?php
namespace Mbattee\ObjectOriented;

use Ramsey\Uuid\Uuid;

// at 14 min mark in constructor video

//load the author class
require_once ("../classes/foo.php");

//use the constructor to create a new author
$author = new Author('e4bb089c-825b-416e-be9a-5948390ac564', 'http://go.com', '11111111112222222222333333333344', 'marsha@sanesuite.com', '62191c364c1a7f400cec5e4a95a94e2f2891976ce479a8533542615e829bd638b73893602129f3d295bdb9ceb60736cfe86282b2e127cba7379251c20a2d2c0385f643dcaeebac0e96a9f3ad91da9bb4c31bb536bbc0cf940ebb7e6eb1db2ccb8d', 'blkjlksdf');

var_dump($author);

?>

