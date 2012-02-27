<?php 
namespace models\journal;

/**
 * This class represents a Journal entry and it's CRUD operations
 * Tightly coupled to MongoDB at the moment but could proxy these CRUD methods to a DAO if needed
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class Entries extends \library\DataStructure
{   
    
    /**
     * Name for this structure
     * 
     * @var string
     */
    protected $_name = 'Entries';
    
    /**
     * Is this structure a collection?
     * 
     * @var bool
     */
    protected $_collection = true;
    
    /**
     * Class to use for child structures under this collection
     * 
     * @var string
     */
    protected $_childStructure = '\models\journal\Entry';
    
    /**
     * Retrieve all journal entries
     * 
     * @return \models\journal\Entry[]
     */
    public static function getAll()
    {
        $mongo = new \Mongo();
        $db = $mongo->selectDB('website');
        $results = $db->journal->find();
        
        $items = array();
        
        foreach( $results as $entry ) 
        {
            $items []= new self($entry);    
        }
        
        return $items;
    }

}

?>