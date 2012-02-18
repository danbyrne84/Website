<?php 
namespace library;

class DataStructure implements \ArrayAccess
{
	/**
	 * Array of keys that defines the schema of the data
	 * 
	 * @var string[]
	 */
	protected $_structure = array();
	
	/**
	 * Array that holds the data
	 * 
	 * @var mixed[]
	 */
	protected $_data = array();
	
	/**
	 * Name of this data structure
	 * 
	 * @var string
	 */
	protected $_name = null;
	
	/**
	 * Is this data structure a collection for other structures?
	 * 
	 * @var bool
	 */
	protected $_collection = false;
	
	/**
	 * The data structure to use for children of this structure
	 * 
	 * @var string
	 */
	protected $_childStructure = null;
	
	/**
	 * Data structure constructor
	 * 
	 * @param mixed[] $data
	 * @param bool    $matchStructure   if true, only matched keys will be imported into the data structure
	 * @param bool    $validate         if true, exception is thrown if structure does not validate
	 */
	public function __construct($data, $matchStructure = true, $validate = true)
	{
		// we can require that the data structure only accepts certain predefined keys
		if( true === $matchStructure ) {
			$this->_data = array_replace($this->_structure, $data);			
		}
		else {
			$this->_data = $data;
		}
		
		// validate data if required
		if (false === $this->validate()) {
			throw new \library\datastructure\Exception('Could not validate data structure [' . get_class($this) . ']');
		}
	}
	
	/**
	 * Check that a given offset exists
	 * 
	 * @see    ArrayAccess interface
	 * @param  mixed $offset
	 * @return bool
	 */
	public function offsetExists($offset)
	{
		return isset($this->_data[$offset]);
	}
	
	/**
	 * Set the value for a given array offset
	 * 
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet($offset, $value)
	{
		$this->_data[$offset] = $value;
	}
	
	/**
	 * Unset the value at a given offset
	 * 
	 * @param mixed $offset
	 */
	public function offsetUnset($offset)
	{
		unset($this->_data[$offset]);
	}
	
	/**
	 * Return value at a given offset
	 * 
	 * @param mixed $offset
	 * @return mixed
	 */
	public function offsetGet($offset)
	{
		return isset($this->_data[$offset]) ? $this->_data[$offset] : null;
	}

	/**
	 * Return the collection as a simple array
	 * @todo recursive
	 * 
	 * @return mixed[]
	 */
	public function getData()
	{
		return $this->_data;
	}
	
	/**
	 * Abstract validation function
	 * 
	 */
	public function validate()
	{
		return true;
	}
}
?>