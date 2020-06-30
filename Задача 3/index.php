<?php
/*
Использование подготовленных запросов улучшает защиту от SQL-инъекций
(изменение входных параметров путём добавления в них конструкций языка SQL вызывает изменение в логике выполнения SQL-запроса).
поставив к примеру просто ковычки можно получить ошибку и в ней может быть описана структура таблицы.
В указанной задаче данные берутся напрямую из GET запроса.
Открывать и закрывать соединение с базой при каждом запросе тоже неочень.
Проще и понятнее получить массив объектов и работать с ним

*/
include_once './DB.php';

/**
 * get row by id from users table
 * @param string $id
 * @param PDO $db
 *
 * @return object
 */
function getUserById($id, $db)
{
    $stmt = $db->prepare("SELECT * FROM users WHERE id= ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    return $user;
}

/**
 * @param array $user_ids_array
 *
 * @return array
 */
function getDataFromDb(array $user_ids_array): array
{
    $db = DB::getInstance();
    $users_array = [];
    foreach ($user_ids_array as $id )
    {
        $users_array[] = getUserById($id, $db);
    }
    unset($db);

    return $users_array;
}

/**
 * @param string $user_ids
 *
 * @return array
 */
function load_users_data(string $user_ids): array
{
    $user_ids_array = explode(',', $user_ids);
    $users = getDataFromDb($user_ids_array);

    return $users;
}

/**
 * @param array $users
 *
 */
function printLinks(array $users)
{
    foreach ($users as $user) {
        //стиль просто для теста чтобы в столбик ссылки были
        echo "<a style='display: block' href=\"/show_user.php?id=$user->id\">$user->name</a>";
    }
}

//$data = load_users_data($_GET['user_ids']);
//заглушка для проверки
$data = load_users_data('1,2,4');

printLinks($data);



