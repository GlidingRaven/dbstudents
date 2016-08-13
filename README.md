# dbstudents

Каждый год в ВУЗы России поступают тысячи абитуриентов со всей страны. Каждый год появляются тысячи приказов о зачислении. Мною была представлена задача найти, обработать и использовать эти ценные данные. В итоге получилось кое-что интересное...

### Схема ввода исходных данных

Если приказ отсканирован, то с помощью ABBYY FineReader оператор переводит картинку в текст и копирует его в поле ввода на служебной странице. Там же он проставляет дату, название ВУЗа и ссылку на оригинал. После чего на сервере происходит волшебство и оператор видит результат, тогда, он проверяет корректность обработанных данных и подтверждает. Данные заносятся в БД MySQL.

Демонстрационная версия страницы оператора [находится в открытом доступе](http://openstudents.ru/adm/panel), но без прохождения процедуры аутентификации добавление данных недоступно.

### Безопасность

Существует лишь 6 файлов, редактирующих БД, все они защищены страшным модулем. В противном случае возвращается ошибка 403.

### Структура

answerer/

	campuses.php 			(список ВУЗов с сортировкой)
	ci.php 					(информация о городе)
	citys.php 				(список городов с сортировкой)
	or.php 					(информация о приказе)
	st.php 					(поиск по БД)
	uz.php 					(информация о ВУЗе)

transformers/

	addercity.php 			(добавление города)
	addersource.php 		(добавление приказа)
	adderuz.php 			(добавление ВУЗа)
	preaddersource.php 		(предосмотр добавления приказа)
	regexper.php 			(изменение регулярного выражения)
	cancelpanel.php 		(панель удаления приказа)
	cancel.php 				(исполнительный файл удаления)

others

	README.md
	htaccess
	panel.html 				(панель оператора)
	mine.js   				(js для панели)
