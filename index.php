<?php

include_once __DIR__ . '/DataBase.php';
include_once __DIR__ . '/App.php';
include_once __DIR__ . '/Console.php';

$console = new \Asika\SimpleConsole\Console;
$app = new App;

$console->execute(function (\Asika\SimpleConsole\Console $console)
{
	global $app;

	if ($app->run()) 
		$console->out('GitHub пользователи успешно импортированы');
	else
		$console->out('Ошибка при выполнении запроса');
	
	return true;
});
