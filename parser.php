<?php
require_once '.\vendor\autoload.php';
require_once '.\config.php';
require_once '.\app\Models\SearchTags.php';
require_once '.\app\Controllers\ParseWildberries.php';

use Controllers\Wildberries\ParseWildberries;

if (empty($_GET['url'])) {
    echo 'Ошибка. Пустая ссылка';
    exit();
}

$ParseWildberries = new ParseWildberries();

$parseTags = $ParseWildberries->runParseSearchTags($_GET['url']);

// если данные пришли - выводим, иначе сообщаем ошибку 
if (!empty($parseTags)) {
    echo '<pre>Были спарсены и записаны в базу следующие поисковые теги:<br>';
    var_dump($parseTags);
} else {
    echo 'Ошибка. список тегов пуст';
}