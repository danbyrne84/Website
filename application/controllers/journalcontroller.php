<?php 

namespace controllers;

class JournalController extends \library\Controller
{
	/**
	 * Constructor
	 * 
	 */
	public function __construct()
	{
		$layout = \library\View::fromFile(APP_PATH . '/layouts/main.tpl');
		$this->setLayout($layout);
	}
	
	/**
	 * List all journal entries
	 * 
	 */
	public function indexAction()
	{
		// retrieve all journal entries from Mongo
		$results = \models\journal\Entry::getAll();
		$view = \library\View::fromFile(APP_PATH . '/views/journal-entry.tpl');
		
		// iterate over the results getting each row as a basic array rather than a data structure
		// @todo implement DataStructure collection plus getData functionality
		
		$entries = array();
		foreach($results as $entry)
		{
			$entries []= $entry->getData();
		}
		
		$view->entries = $entries;
		
		$this->getLayout()->content = $view;
		$this->render();
	}

	/**
	 * Action for displaying processing a new journal entry
	 * 
	 */
	public function createAction()
	{
		// load in the journal entry page and it's associated form
		$view = \library\View::fromFile(APP_PATH . '/views/new-journal-entry.tpl');
		$form = \library\View::fromFile(APP_PATH . '/views/forms/journal-entry.tpl');

		// if we've received a posted form, process it
		if(isset($_POST['formvar']) && 'journal-create' === $_POST['formvar'])
		{	
			// parse the given date into a timestamp
			$valid = true;
			$timestamp = strtotime($_POST['date']);
			
			// now into a \DateTime object that the structure requires
			if (false !== $timestamp) 
			{
				$date = new \DateTime($timestamp);
			}
			else 
			{
				$valid = false;
				$message = 'Sorry, the date that you entered could not be recognised. Please use the formate d-m-y';
			}
			
			if( true === $valid ) 
			{
				try 
				{	
					$data = array (
						'author'  => $_POST['author'],
						'date'    => $date,
					    'subject' => $_POST['subject'],
					    'body'    => $_POST['body'],
						'mood'    => $_POST['mood']		
					);
					
					$entry = new \models\journal\Entry($data);
					$entry->save();
					$view->message = 'Journal entry saved.';
				}
				catch(\library\datastructure\Exception $ex)
				{
					$view->message = 'Sorry, there was a problem validating the journal entry. Please try again.';
				}
			}
			else 
			{
				$view->message = $message;
			}
		}
		else
		{
			$view->form = $form;
		}
		
		$this->getLayout()->content = $view;
		$this->render();
	}
	
	public function readAction()
	{
		
	}
}

?>