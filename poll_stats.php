<? 
	include('database/polls_fetch.php');
	include('templates/header.php'); 
	include('user.php');
	include_once('templates/showPolls.php');

	$all_groups = getAnsweredGroups(getUserIDbyUsername($_SESSION['username']));

	include('search_poll.php'); 

	foreach($all_groups as $item1){ 
		showPollGroupStat($item1);
	} 

	include('templates/footer.php');
?>