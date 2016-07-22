# dbstudents

Каждый год в ВУЗы России поступают тысячи абитуриентов со всей страны. Каждый год появляются тысячи приказов о зачислении. Мною была представлена задача найти, обработать и использовать эти ценные данные. В итоге получилось кое-что интересное...

### Схема ввода исходных данных

С помощью ABBYY FineReader оператор переводит pdf'ку приказа в текст и копирует его в поле ввода на служебной странице. Там же он проставляет дату, название ВУЗа и ссылку на оригинал. После чего на сервере происходит волшебство и оператор видит результат, тогда, в свою очередь, он проверяет корректность обработанных данных и подтверждает правильность. Данные заносятся в БД MySQL.

Страница оператора [находится в открытом доступе](http://ravengo.ru/forspec/), но без прохождения процедуры аутентификации добавление данных недоступно.

### Безопасность

Существует лишь 4 файла, ответственных за добавление информации в БД, для их использования необходим пароль, в противном случае возвращается ошибка 403.