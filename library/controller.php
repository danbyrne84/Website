<?php 
namespace library;

/**
 * Abstract controller class
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class Controller
{
	/**
	 * Layout variable
	 * 
	 * @var \library\View
	 */
	protected $_layout = null;
	
	/**
	 * Returns the layout used by this controller
	 * 
	 * @var \library\View
	 */
	public function getLayout()
	{
		return $this->_layout;
	}
	
	/**
	 * setLayout
	 * Set the layout to be used by this controller
	 * 
	 * @param \library\View $layout
	 */
	public function setLayout(\library\View $layout)
	{
		$this->_layout = $layout;
	}
	
	/**
	 * Proxies the render call onto the layout object
	 * Use this function to inject any last minute data into the layout as needed
	 * 
	 */
	public function render()
	{
		$runtime = round(microtime() - START_TIME, 4);
		$this->_layout->runtime = 'page generated in ' . $runtime . ' ms';
		
		$this->_layout->render();
	}
}
?>