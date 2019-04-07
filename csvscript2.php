<?php 
//открываем файл. Если его нет, завершаем работу скрипта и выводим ошибку
$file = fopen("MOCK_DATA_TEST_TI.csv", 'r+') or die("Не удалось подключть файл");

//считываем данные в цикле
$x = 0;
$arr = array();
while (($data = fgetcsv($file)) !== FALSE) {
  //определяем количество полей в строке
  $pole = count($data);
  // выводим эту информацию
  echo "Строка $x содержит $pole поля:";
  // Условие для пропуска первой строки с оглавлением
  if ($x == 0) {
//Вывод на экран
print_r($data);
//Запись в файл
$fp = fopen('MOCK_DATA_TEST_TI(edit).csv', 'a+');
fputcsv($fp,$data);
fclose($fp);
$x++;
    } else {
//Удаление всех символов кроме цифр в поле phone
$val = preg_replace('/[^0-9]/', '', $data[6]);
$data[6] = $val;
//Изменение формата даты с yyyy-mm-dd на dd.mm.yy в поле birthday
$yy = substr($data[8],2,2);
$mm = substr($data[8],5,2);
$dd = substr($data[8],8,2);
$data[8] = $dd . '.' . $mm . '.' . $yy;
//Вывод на экран
print_r($data);
//Запись в файл
$fp = fopen('MOCK_DATA_TEST_TI(edit).csv', 'a+');
fputcsv($fp,$data);
fclose($fp);
$x++;
	}
}
fclose($file);

?>