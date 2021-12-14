<?php
namespace Models\Wildberries;

use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

class SearchTags {
	
	private $dbConnect;
	
	/**
	 * Конструктор
	 *
	 * @return void
	 */
	public function __construct() {
		$dbConnect = $this->connectToDB();
	}
	
	/**
	 * коннект к БД
	 *
	 * @return void
	 */
	private function connectToDB() {
		
		$pdo = new PDOConnector(...CONFIG_DATE_BASE);

		$pdoConn = $pdo->connect('utf8', []);
		$this->dbConnect = new Mysql($pdoConn);
	}
	
	/**
	 * Сохранить тег в таблицу
	 *
	 * @param string $nameTag имя тега
	 *
	 * @return void
	 */
	public function saveTagToDB(string $nameTag) {
		
		$data = [
			'name_tag'   => $nameTag
		];
		
		$this->dbConnect->insert('search_tags', $data);
	}
}