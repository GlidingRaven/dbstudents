<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>regexper</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<?php
	$re_spec = "/(\\b\\d{2}\\.\\d{2}\\.\\d{2}\\b)/";
	//$re_stud = "/([А-ЯЁ][а-яё]+)\\s([А-ЯЁ][а-яё]+)\\s([А-ЯЁ][а-яё]+)\\s.{0,20}(\\d{3})/u";
	$stud = file('regex.txt'); $re_stud = $stud[0];
	var_dump($re_stud);
	//fclose($fp);
	exit();
	$str = "﻿МИНИСТЕРСТВО ОБРАЗОВАНИЯ И НАУКИ РОССИЙСКОЙ ФЕДЕРАЦИИ\nФЕДЕРАЛЬНОЕ ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ\nВЫСШЕГО ОБРАЗОВАНИЯ\n«НОВОСИБИРСКИЙ ГОСУДАРСТВЕННЫЙ ТЕХНИЧЕСКИЙ УНИВЕРСИТЕТ»\nПРИКАЗ\nот	07.08.2015\n№	4029/2\nО студенческом составе ФМА\nП Р И К А З Ы В А Ю:\n1.	В связи с зачислением по более высокому приоритету приказ №4006/2 от 04.08.2015г. пункт 3 о зачислении в состав студентов первого курса очной формы обучения, на бюджетную основу обучения по направлению 13.03.02 Электроэнергетика и электротехника (высшее образование - бакалавриат) в отношении следующих абитуриентов отменить:\n1.	Ильин Владислав Юрьевич\n2.	Сабадаш Инна Алексеевна\n3.	Сергеев Данил Витальевич\n4.	Солохин Даниил Игоревич\n5.	Титов Василий Андреевич\n6.	Хомутовский Станислав Игоревич\n7.	Цыганков Денис Александрович\n8.	Шалыгин Андрей Викторович\n9.	Шереметьев Никита Евгеньевич\nОснование: заявления абитуриентов, решение приемной комиссии, представление декана.\n2.	В связи с зачислением по более высокому приоритету приказ №4006/2 от 04.08.2015г. пункт 5 о зачислении в состав студентов первого курса очной формы обучения, на контрактную основу обучения по направлению 38.03.02 Менеджмент (высшее образование - бакалавриат) в отношении следующего абитуриента отменить:\n1. Ена Иван Павлович\nОснование: заявление абитуриента, решение приемной комиссии, представление декана.\n3.	В соответствии с решением приемной комиссии НГТУ, протокол №3 от 07.08.2015 г., зачислить с 01.09.2015 г. в состав студентов первого курса очной формы обучения для обучения на бюджетной основе (за счет бюджетных ассигнований федерального бюджета) по образовательной программе высшего образования - программе бакалавриата 15.03.04 Автоматизация технологических процессов и производств, профиль (направленность) образовательной программы «Автоматизация технологических процессов и производств в нефтегазовом комплексе», следующих абитуриентов:\n№	ФИО.	Категория	Балл\n1	Зотов Данил Владимирович	по конкурсу	264\nОснование: решение приемной комиссии, представление декана.\n4.	В соответствии с решением приемной комиссии НГТУ, протокол №3 от 07.08.2015 г., зачислить с 01.09.2015 г. в состав студентов первого курса очной формы обучения для обучения на бюджетной основе (за счет бюджетных ассигнований федерального бюджета) по образовательной программе высшего образования - программе бакалавриата 19.03.04 Технология продукции и организация общественного питания, профиль (направленность) образовательной программы «Технология и организация ресторанного сервиса», следующих абитуриентов:\n№	ФИО.	Категория	Балл\n1	Геращенко Надежда Сергеевна	по конкурсу	224\n2	Казакова Анастасия Леонидовна	по конкурсу	222\n3	Малгатаева Мария Сергеевна	по конкурсу	227\n4	Мартынова Елизавета Георгиевна	по конкурсу	223\n5	Шереметьев Никита Евгеньевич	по конкурсу	221\nОснование: решение приемной комиссии, представление декана.\n5.	В соответствии с решением приемной комиссии НГТУ, протокол №3 от 07.08.2015 г., зачислить с 01.09.2015 г. в состав студентов первого курса очной формы обучения для обучения на бюджетной основе (за счет бюджетных ассигнований федерального бюджета) по образовательной программе высшего образования - программе бакалавриата 13.03.02 Электроэнергетика и электротехника следующих абитуриентов:\n№	ФИО.	Категория	Балл\n1	Акифьев Никита Владимирович	по конкурсу	216\n2	Блинов Артур Андреевич	по конкурсу	215\n3	Брынзова Анжелика Николаевна	по конкурсу	206\n4	Бугаков Дмитрий Александрович	по конкурсу	219\n5	Ващенко Андрей Александрович	по конкурсу	208\n6	Гвоздик Егор Андреевич	по конкурсу	215\n7	Грызунова Татьяна Васильевна	по конкурсу	215\n8	Дубинина Ирина Валерьевна	по конкурсу	214\n9	Еремич Павел Евгеньевич	по конкурсу	205\n10	Ефименко Владислав Витальевич	по конкурсу	214\n11	Ефимова Ольга Андреевна	по конкурсу	217\n12	Зорин Георгий Алексеевич	по конкурсу	206\n13	Ким Родион Юрьевич	по конкурсу	214\n14	Климанов Тимур Витальевич	по конкурсу	214\n15	Новоселов Алексей Николаевич	по конкурсу	217\n16	Приймак Леонид Владимирович	по конкурсу	210\n17	Ротарь Данил Николаевич	по конкурсу	206\n18	Сажин Никита Олегович	по конкурсу	207\n19	Сёмка Родион Евгеньевич	по конкурсу	215\n20	Сиделева Ольга Владимировна	по конкурсу	209\n21	Старшун Анатолий Валерьевич	по конкурсу	213\n22	Тумашев Никита Алексеевич	по конкурсу	210\n23	Федотченко Филипп Сергеевич	по конкурсу	208\n24	Шрейдер Александр Владимирович	по конкурсу	216\n25	Яковлев Михаил Вадимович	по конкурсу	211\nОснование: решение приемной комиссии, представление декана.\n6.	В соответствии с решением приемной комиссии НГТУ, протокол №3 от 07.08.2015 г., зачислить с 01.09.2015 г. в состав студентов первого курса очной формы обучения для обучения на контрактной основе (с оплатой стоимости обучения физическими и (или) юридическими лицами) по образовательной программе высшего образования - программе бакалавриата 15.03.04 Автоматизация технологических процессов и производств, профиль (направленность) образовательной программы «Автоматизация технологических процессов и производств в нефтегазовом комплексе», следующих абитуриентов:\n№	ФИО.	Категория	Балл\n1	Алексеев Дмитрий Владимирович	по конкурсу	147\n2	Антропов Дмитрий Николаевич	по конкурсу	143\n3	Афанасьев Павел Павлович	по конкурсу	231\n4	Баранов Владимир Анатольевич	по конкурсу	135\n5	Вобликов Александр Сергеевич	по конкурсу	180\n6	Воронов Денис Александрович	по конкурсу	169\n7	Дайнес Артур Владимирович	по конкурсу	155\n8	Денисов Александр Вячеславович	по конкурсу	172\n9	Кишкарёва Арина Васильевна	по конкурсу	200\n10	Кокишев Ерик Серикович	по конкурсу	170\n11	Лебеденко Владислав Сергеевич	по конкурсу	159\n12	Майборода Михаил Александрович	по конкурсу	172\n13	Никулин Максим Юрьевич	по конкурсу	164\n14	Носкова Анастасия Анатольевна	по конкурсу	163\n15	Паксин Глеб Владимирович	по конкурсу	186\n16	Савенков Владислав Александрович	по конкурсу	226\n17	Солонко Виктория Вячеславовна	по конкурсу	163\n18	Уфимцев Аркадий Валерьевич	по конкурсу	151\n19	Фоменко Андрей Сергеевич	по конкурсу	187\n20	Цамалаидзе Дарья Гигушаевна	по конкурсу	153\n21	Цирельников Владимир Сергеевич	по конкурсу	155\n22	Шипняков Максим Леонидович	по конкурсу	156\n23	Штефан Артем Андреевич	по конкурсу	152\nОснование: решение приемной комиссии, представление декана.\n7.	В соответствии с решением приемной комиссии НГТУ, протокол №3 от 07.08.2015 г., зачислить с 01.09.2015 г. в состав студентов первого курса очной формы обучения для обучения на контрактной основе (с оплатой стоимости обучения физическими и (или) юридическими лицами) по образовательной программе высшего образования - программе бакалавриата 19.03.04 Технология продукции и организация общественного питания, профиль (направленность) образовательной программы «Технология и организация ресторанного сервиса», следующих абитуриентов:\n"; 
 
	$answer_specialization = preg_match_all($re_spec, $str, $matches_spec, PREG_OFFSET_CAPTURE);
	$answer_students = preg_match_all($re_stud, $str, $matches_stud, PREG_OFFSET_CAPTURE);

	//print_r($matches_spec);
	//print_r($matches_stud);

	//Начали перевод ин-ции в более удобный вид
	if ($answer_students >= 1) {
		for ($i=0; $i < $answer_students; $i++) { 
			$db_students[$i][0] = $matches_stud[0][$i][1];//position in original text
			$db_students[$i][1] = $matches_stud[1][$i][0];//surname
			$db_students[$i][2] = $matches_stud[2][$i][0];//name
			$db_students[$i][3] = $matches_stud[3][$i][0];//patronymic
			$db_students[$i][4] = $matches_stud[4][$i][0];//sum
			$db_students[$i][5] = "00.00.00";//specialization
		}
		//Расстановка специальностей
		if ($answer_specialization >= 1) {
			for ($i=0; $i < $answer_specialization; $i++) {
				for ($k=0; $k < $answer_students; $k++) { 
					if ($db_students[$k][0] > $matches_spec[0][$i][1]) {
						$db_students[$k][5] = $matches_spec[0][$i][0];
					}
				}
			}}
	}
	else {
		echo "Data not available, bitch";
	}
	print_r($db_students);
	echo "<br><br><br>\n";

	echo '<table class="table table-striped"><thead><tr><th>#</th><th>surname</th><th>name</th><th>patronymic</th><th>sum</th><th>specialization</th></tr></thead><tbody>'."\n";
      for($i=0; $i < $answer_students; $i++) {
        $nuka = $i + 1;
        echo "<tr><td>".$nuka.'</td><td>'.$db_students[$i][1].'</td><td>'.$db_students[$i][2].'</td><td>'.$db_students[$i][3].'</td><td>'.$db_students[$i][4].'</td><td>'.$db_students[$i][5]."</td></tr>\n";
      }
    echo "</tbody></table>\n";
?>
</body>
</html>