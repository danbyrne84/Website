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
	 * Load blog entries from the cache, but do it intelligently
	 * 
	 * Will always retrieve the latest entries but has the overhead of an extra HTTP HEAD request
	 * to get the entity tag for the feed
	 * 
	 * @return bool
	 */
	protected function _loadFromCache()
	{
		// try and load the entity tag record from the cache
        $cache = new \library\cache\Apc();
        $etag = $cache->get('blog_posts_etag');
        
        // now do a HEAD request to the server and retrieve the current E-Tag
		stream_context_set_default(array(
            'http' => array(
                'method' => 'HEAD'
		    )
		));
        
        $headers = get_headers($this->_feedUri);
        $filtered = array_values(array_filter($headers, function($header){
        	return substr($header,0,4) == 'ETag';
        }));
        
        // If E-Tag matches retrieve blog posts from cache
        if (count($filtered) > 0 && $etag === $filtered[0]){
        	return $cache->get('blog_posts');
        }
        // Else reset the E-Tag to the current value and return false
        else{
        	$cache->set('blog_posts_etag', $filtered[0]);
        	return false;
        }
	}
	
	/**
	 * Get latest posts
	 * 
	 * @param int $limit
	 */
	public function getLatest($limit)
	{
		// first try and load these items from APC
		$cache = new \library\cache\Apc();
		if (false !== ($latestPosts = $this->_loadFromCache())){
			return $latestPosts;
		}		
		
		// if we haven't got a cache hit, make an HTTP request to the feed
		$doc = new \DomDocument();
		$doc->load($this->_feedUri);
		
		$xpath = new \DOMXPath($doc);
		$results = $xpath->query('(//rss/channel/item)[position() <= ' . $limit . ']');
		$entries = array();
		
		// construct a BlogEntry item from each 'item' node
		foreach( $results as $result )
		{
			$title = $xpath->query('title', $result)->item(0)->nodeValue;
			$link = $xpath->query('link', $result)->item(0)->nodeValue;
			$description = $xpath->query('description', $result)->item(0)->nodeValue;
			$author = $xpath->query('dc:creator', $result)->item(0)->nodeValue;
			
			$entries []= new wordpress\BlogEntry($title, $link, $description, $author);
		}
		
        // set these blog entries in the cache for next view
		$cache->set('blog_posts', $entries);
		
		return $entries;
	}
	
}

?>