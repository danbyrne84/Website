<?php

namespace library;

class Form
{
    /**
     * Name of the form
     * @var null
     */
    protected $_formName = null;

    /**
     * Constructor
     * @param $formName
     */
    protected function __construct($formName)
    {
        $this->_formName = $formName;
    }

    /**
     * Retrieve an instance of the form helper
     *
     * @static
     * @return Form
     */
    public static function getInstance($formName)
    {
        return new self($formName);
    }

    /**
     * Check if a given form is posted
     * If no name is given, just check for any post data
     *
     * @static
     * @param string $name
     */
    public static function isPosted($name = null)
    {
        if(null !== $name) {
            // check for a hidden field with the name of the form to indicate postback
            return( isset( $_POST['formvar'] ) && $_POST['formvar'] === $name);
        }

        return null !== $_POST && count($_POST > 0);
    }

    /**
     * Retrieve the value for a specific element submitted through a form
     *
     * @param $formElement
     * @return null | mixed
     */
    public function getValue($formElement)
    {
        if( !isset( $_POST[$formElement] ) ) {
            return null;
        }

        return $_POST[$formElement];
    }
}

?>