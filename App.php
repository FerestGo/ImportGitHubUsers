<?php

/**
 *  App Class
 */
class App
{
	/**
     * Stores url json github
     *
     * @var string
     */
	private $url = 'https://api.github.com/users';

	 /**
     * Stores users param
     *
     * @var array
     */
	 private $users = array();

	 function __construct()
	 {
	 	$this->getUsers();	
	 }

	 /**
     * run
     *
     * @return  bool
     */
	 public function run()
	 {
	 	if ($this->insertOrUpdateUsers()) 
	 		return true;
	 	else
	 		return false;
	 }


	 /**
     * getUser
     *
     * @return  array|bool
     */
	 private function getUsers()
	 {
		// Request with a fake user agent
	 	$context = stream_context_create(
	 		array(
	 			"http" => array(
	 				"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
	 			)
	 		)
	 	);
	 	$url = $this->url;
	 	$json = @file_get_contents($url, false, $context);
	 	if(trim($json)!='')
	 		$arr = json_decode($json, true);
	 	else 
	 		return false;
	 	$this->users = $arr;
	 }

	/**
     * insertOrUpdateUsers
     *
     * @return  bool
     */
	private function insertOrUpdateUsers()
	{
		global $pdo;
		$users = $this->users;
		foreach ($users as $id => $user) {
			$github_id = $user['id'];
			$github_login = $user['login'];
			$sth = $pdo->prepare('INSERT INTO user(github_id, github_login) 
				VALUES (?, ?) 
				on duplicate key update github_login = values(github_login)');
			$sth->bindParam(1, $github_id, PDO::PARAM_INT);
			$sth->bindParam(2, $github_login, PDO::PARAM_STR);
			if ($sth->execute()) 
				return true;
			else
				return false;
		}
	}
}
