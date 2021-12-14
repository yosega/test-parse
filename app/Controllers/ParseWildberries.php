<?php
namespace Controllers\Wildberries;

use Symfony\Component\DomCrawler\Crawler;
use Models\Wildberries\SearchTags;

class ParseWildberries {
	
	/**
	 * Запустить парсер поисковых тегов 
	 * 
	 * @param string $url ссылка на страницу товара
	 *
	 * @return void
	 */
	public function runParseSearchTags($url): array {

		$res = [];
		
		$SearchTagsModel = new SearchTags();
		$pageHtml = $this->getHtml($url);
		$tagList = $this->parseSearchTagsFromHtml($pageHtml['content']);
		foreach ($tagList as $item) {
			$SearchTagsModel->saveTagToDB($item);
			$res[] = $item;
		}

		return $res;
	}
	
	/**
	 * Получить HTML по ссылке через curl
	 *
	 * @param string $url ссылка, по котором получаем HTML
	 *
	 * @return array
	 */
	private function getHtml(string $url): array {

		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "google chrome", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;
	}

	/**
	 * найти в html поисковые теги со страницы товара 
	 *
	 * @param string $html тело страницы
	 *
	 * @return array
	 */
	private function parseSearchTagsFromHtml(string $html): array {
		
		$crawler = new Crawler($html);
		$itemList = $crawler->filter('.search-tags > ul a')->each(function (Crawler $node, $i) {
			return $node->text();
		});
		return $itemList;
	}
}