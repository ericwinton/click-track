<?php

include "connect.php";

$linkID = $_POST['linkID'];
$linkHref = $_POST['linkHref'];
$linkText = $_POST['linkText'];
$one = 1;

$stmtCheck = $pdo->prepare("SELECT link_id FROM clicks WHERE link_id = ?");
$stmtCheck->execute(array($linkID));
$numRows = $stmtCheck->rowCount();

if ($numRows > 0) {
	$stmtAdd = $pdo->prepare("UPDATE clicks SET count = count+1 WHERE link_id = ?");
	$stmtAdd->execute(array($linkID));
} else {
	$stmtAdd = $pdo->prepare("INSERT INTO clicks (link_id,link_href,link_text,count) VALUES (?,?,?,?)");
	$stmtAdd->execute(array($linkID,$linkHref,$linkText,$one));
}

?>