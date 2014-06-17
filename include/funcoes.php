<?php
function sqlCommandNUM($banco,$stringQuery,$arrayExecute){
	$sqlCommand = $banco->prepare($stringQuery);
	$sqlCommand->execute($arrayExecute);
	
	return $ver = $sqlCommand->fetch(PDO::FETCH_NUM);
	
}
function limitarC($string, $limit){
	if(strlen($string) > $limit){
		return substr($string, 0, $limit).'...';
	}else{
		return $string;
	}
}
function addDayIntoDate($date,$days) {
$thisyear = substr ( $date, 0, 4 );
$thismonth = substr ( $date, 4, 2 );
$thisday = substr ( $date, 6, 2 );
$nextdate = mktime ( 0, 0, 0, $thismonth, $thisday + $days, $thisyear );
return strftime("%Y%m%d", $nextdate);
}
?>