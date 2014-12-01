<?php
	
	$stmtGetSum = $pdo->prepare("SELECT SUM(count) AS total FROM clicks");
	$stmtGetSum->execute(array());
	while ($row = $stmtGetSum->fetch()) {
		$totalClicks = $row["total"];
	}
	
	$stmtGetAll = $pdo->prepare("SELECT * FROM clicks ORDER BY count DESC");
	$stmtGetAll->execute(array());
	$numRows = $stmtGetAll->rowCount();
	
	while ($row = $stmtGetAll->fetch()) {
		echo '<div class="click-data" data-id="'.$row["link_id"].'" data-count="'.$row["count"].'"><span class="info">'.$row["count"].'</span></div>';
	}

	echo '<div id="total-clicks">'.$totalClicks.'</div>';
?>