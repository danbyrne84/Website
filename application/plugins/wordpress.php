<?php 
namespace plugins;

/**
 * Basic wordpress integration class
 * Uses RSS feed rather than XML-RPC
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class Wordpress
{
	/**
	 * Feed Uri
	 * 
	 * @var string
	 */
	protected $_feedUri = null;
	
	/**
	 * Constructor
	 * Initialize the wordpress plugin using a URI
	 * 
	 * @param string $apiUrl
	 */
	public function __construct($feed)
	{
		$this->_feedUri = $feed;
	}
	
	/**
	 * Get latest posts
	 * 
	 * @param int $limit
	 */
	public function getLatest($limit)
	{
		$doc = new \DomDocument();
		$doc->load($this->_feedUri);
		
		$xpath = new \DOMXPath($doc);
		$results = $xpath->query('(//rss/channel/item)[position() <= ' . $limit . ']');
		$entries = array();
		
		foreach( $results as $result )
		{
			$title = $xpath->query('title', $result)->item(0)->nodeValue;
			$link = $xpath->query('link', $result)->item(0)->nodeValue;
			$description = $xpath->query('description', $result)->item(0)->nodeValue;
			$author = $xpath->query('dc:creator', $result)->item(0)->nodeValue;
			
			$entries []= new wordpress\BlogEntry($title, $link, $description, $author);
		}
		
		return $entries;
	}
	
}

?>