<?php 
namespace models\journal;

/**
 * This class represents a Journal entry and it's CRUD operations
 * Tightly coupled to MongoDB at the moment but could proxy these CRUD methods to a DAO if needed
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class Entry extends \library\DataStructure
{	
	
	/**
	 * Name for this structure
	 * 
	 * @var string
	 */
	protected $_name = 'Entry';
	
	/**
	 * Is this structure a collection?
	 * 
	 * @var bool
	 */
	protected $_collection = false;
	
	/**
	 * Data schema for this class
	 * 
	 * @var mixed[]
	 */
	protected $_structure = array (
		'author'  => null,
		'date'    => null,
	    'subject' => null,
	    'body'    => null,
		'mood'    => null
	);
	
	/**
	 * Retrieve all journal entries
	 * 
	 * @return \models\journal\Entry[]
	 */
	public static function getAll()
	{
		$mongo = new \Mongo();
		$db = $mongo->selectDB('website');
		$results = $db->journal->find()->sort(array('date' => '-1'));
		
		$items = array();
		
		foreach( $results as $entry ) 
		{
			try
			{
				$items []= new self($entry);
			}
			catch(\library\datastructure\Exception $ex)
			{
				// do nothing for the time being
			}
		}
		
		return $items;
	}

	/**
	 * Save the journal entry
	 * 
	 */
	public function save()
	{
		$mongo = new \Mongo();
		$db = $mongo->selectDB('website');
		$db->journal->insert($this->_data);
	}
	
	/**
	 * Validate this journal entry
	 * 
	 */
	public function validate()
	{
		// validate required keys are present
		$diff = array_diff(
			array('author','date','subject','body'),
			array_keys($this->_data)
		);
		if(count($diff) > 0){ return false; }
		
		return true;
	}
	
}

?>