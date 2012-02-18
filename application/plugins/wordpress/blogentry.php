<?php 
namespace plugins\wordpress;

/**
 * Class to model a blog entry
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class BlogEntry
{
	/**
	 * Post Title
	 * 
	 * @var string
	 */
	protected $_title = null;
	
	/**
	 * Link to blog entry
	 * 
	 * @var string
	 */
	protected $_link = null;
	
	/**
     * Description
     * 
     * @var string
	 */
	protected $_description = null;
	
	/**
     * Author
     * 
     * @var string
	 */
	protected $_author = null;
	
	/**
	 * Constructor
	 * 
	 * @param string $title
	 * @param string $link
	 * @param string $description
	 * @param string $author
	 */
	public function __construct($title, $link, $description, $author)
	{
		$this->_title = $title;
		$this->_link = $link;
		$this->_description = $description;
		$this->_author = $author;
	}
	
	/**
	 * Get post title
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_title;
	}
	
	/**
	 * Get post link
	 * 
	 * @return string
	 */
	public function getLink()
	{
		return $this->_link;
	}
	
	/**
	 * Get post description
	 * 
	 * @return string
	 */
	public function getDescription()
	{
		return $this->_description;
	}
	
	/**
	 * Get author
	 * 
	 * @return string
	 */
	public function getAuthor()
	{
		return $this->_author;
	}
	
	/**
	 * Return array representation of this object
	 * 
	 * @return string[]
	 */
	public function toArray()
	{
		return array(
			'title'      => $this->getTitle(),
			'link'        => $this->getLink(),
			'description' => $this->getDescription(),
			'author'      => $this->getAuthor(),
		);
	}
	
}

?>