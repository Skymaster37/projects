<?php
// Content of hello_world.php
 
// Pipedrive API token
$api_token = '71f72f477bf822717cb22c5bf830271d0836fa19';

// Pipedrive company domain
$company_domain = 'magneticonegroup-48ab38';
 
//URL for Deal listing with your $company_domain and $api_token variables
$url = 'https://'.$company_domain.'.pipedrive.com/v1/deals?api_token=' . $api_token;
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
echo 'Sending request for Deals...' . PHP_EOL;
 
$output = curl_exec($ch);
curl_close($ch);
 
$result = json_decode($output, true);

if (empty($result['data'])) {
    exit('No deals created yet' . PHP_EOL);
}

//URL for Organization listing with your $company_domain and $api_token variables
$url2 = 'https://'.$company_domain.'.pipedrive.com/v1/organizations/list?api_token=' . $api_token;
 
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
 
echo 'Sending request for Organizations...' . PHP_EOL;
 
$output2 = curl_exec($ch2);
curl_close($ch2);
 
$result2 = json_decode($output2, true);

if (empty($result2['data'])) {
    exit('No organizations created yet' . PHP_EOL);
}

//URL for Person listing with your $company_domain and $api_token variables
$url3 = 'https://'.$company_domain.'.pipedrive.com/v1/persons/list?api_token=' . $api_token;
 
$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_URL, $url3);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
 
echo 'Sending request for Persons...' . PHP_EOL;
 
$output3 = curl_exec($ch3);
curl_close($ch3);
 
$result3 = json_decode($output3, true);

if (empty($result3['data'])) {
    exit('No persons created yet' . PHP_EOL);
}

//Перебор массивов и вывод
echo ' ' . PHP_EOL;
echo 'Список организаций:' . PHP_EOL;
foreach ($result2['data'] as $key => $org) {
    $org_title = $org['name'];
  		// Print out
			echo 'Организация #' . ($key + 1) . ': ' . $org_title . PHP_EOL;
}

echo ' ' . PHP_EOL;
echo 'Список контактов:' . PHP_EOL;
foreach ($result3['data'] as $key => $person) {
    $person_title = $person['name'];
  		// Print out
			echo 'Контакт #' . ($key + 1) . ': ' . $person_title . PHP_EOL;
}

echo ' ' . PHP_EOL;
echo 'Список сделок:' . PHP_EOL;
foreach ($result['data'] as $key => $deal) {
    $deal_title = $deal['title'];
  		// Print out
			echo 'Сделка #' . ($key + 1) . ': ' . $deal_title . PHP_EOL;
}

echo ' ' . PHP_EOL;
echo 'Список задач:' . PHP_EOL;
foreach ($result['data'] as $key => $act) {
    $act_title = $act['next_activity_subject'];
	$deal_title = $act['title'];
	$person_title = $act['person_name'];
	$org_title = $act['org_name'];
	$actdate_title = $act['next_activity_date'];
	$acttime_title = $act['next_activity_time'];
	$actdur_title = $act['next_activity_duration'];
		// Исправление времени
		$hour = substr($act['next_activity_time'],0,2);
		$oldhour = (int)$hour;
		$newhour = $oldhour+3;
		$acttime_title = str_replace($hour, $newhour, $act['next_activity_time']);
		// Print out
			echo 'Задача #' . ($key + 1) . ': ' . PHP_EOL;
			echo 'Тема: ' . $act_title . PHP_EOL;
			echo 'Сделка: ' . $deal_title . PHP_EOL;
			echo 'Контактное лицо: ' . $person_title . PHP_EOL;
			echo 'Организация: ' . $org_title . PHP_EOL;
			echo 'Срок выполнения: ' . $actdate_title . ' ' . $acttime_title . PHP_EOL;
			echo 'Продолжительность: ' . $actdur_title . PHP_EOL;
			echo ' ' . PHP_EOL;
}