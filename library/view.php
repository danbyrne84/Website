<?php

namespace library;

/**
 * View
 * This class models a (usually HTML) template which data can be dropped into
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class View
{

    /**
     * Template content
     *
     * @var string
     */
    protected $_content;

    /**
     * A collection of key/value pairs - tags to be replaced with content
     *
     * @var mixed[]
     */
    protected $_data = array();

    /**
     * Constructor
     *
     * @param string    $content
     * @param \stdClass $model
     */
    public function __construct($content, $data = array())
    {
        $this->_content = $content;
        $this->_data = $data;
    }

    /**
     * Return an instance of View from a given template
     *
     * @param string $path
     * @return \library\View
     */
    public static function fromFile($path)
    {
        if(!file_exists($path)){
            throw new view\ViewException("Template does not exist [$path]");
        }

        $template = file_get_contents($path);

        if (false === $template){
            throw new view\ViewException("Unable to load template [$path]");
        }

        return new self($template);
    }

    /**
     * _parseSubviews
     * Look for and replace looping constructs with appropriate subviews
     *
     * @param  string $content
     * @return string 
     */
    protected function _parseSubviews($content)
    {
        // look for looping constructs and instantiate a new view, passing the model
        $matchCount = preg_match_all('/{(?<tag>[\w]*)}(?<content>[\s\S]*){\/\1}/', $content, $matches);
        
        if ($matchCount > 0){
            // combine the tags and content returned from the regexp
            $replacements = array_combine(
                array_values($matches['tag']),
                array_values($matches['content'])
            );            
            // replace the matched tags with their subviews
            foreach($replacements as $tag => $replacement){
                if(isset($this->_data[$tag]) && is_array($this->_data[$tag])){
                    // this case handles an array of arrays, for a looping construct
                    // @todo single array of values will just require one subview
                    $subviews = array();
                    foreach ($this->_data[$tag] as $index => $data) {
                        if( method_exists($data, 'toArray') ){
                            $data = $data->toArray();
                        }
                        $subviews []= new self($replacement, $data);
                    }
                    $content = preg_replace('/{(' . $tag . ')}[\s\S]*{\/\1}/', implode(PHP_EOL, $subviews), $content);
                }
            }
        }
        
        return $content;
    }
    
    /**
     * Parse member variables into placeholders within this view
     * 
     * @param  string $content
     * @return string
     */
    protected function _parseVariables($content)
    {
        // replace any template variables if found in data array
        $replacements = array_filter($this->_data, function($item){
            return is_scalar($item) || $item instanceof View;
        });

        $patterns = array();
        foreach ($replacements as $key => $val) {
            $patterns[$key] = "/\{$key\}/";
        }
        
        // return parsed content
        $content = preg_replace($patterns, $replacements, $content);
        return $content;
    }
    
    /**
     * Repace unmatched template variables with empty strings
     *
     * @param $content
     */
    public function _parseUnmatched($content)
    {
        return preg_replace('/{[a-zA-Z_]*}/','', $content);
    }

    /**
     * Magic setter
     * 
     * @param string $key
     * @param string $value
     */
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
        
        // render this view as soon as something is set
        $this->_content = $this->_parseVariables($this->_content);
        $this->_content = $this->_parseSubviews($this->_content);
    }

    /**
     * Append content after a given key
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function append($key, $value)
    {
        $key = '{' . $key . '}';

        //find given pattern
        $pos = strpos($this->_content, $key);
        if (false === $pos){ return false; }

        $this->_content = str_replace($key, $key . $value, $this->_content);
    }

    /**
     * Return string representation of this view, with template values filled
     *
     * @return string
     */
    public function __toString()
    {   
        $parsed = $this->_parseSubviews($this->_content);
        $parsed = $this->_parseVariables($parsed);
        $parsed = $this->_parseUnmatched($parsed);

        return $parsed;
    }
    
    /**
     * Renders this layout
     * 
     * @return void
     */
    public function render()
    {
        echo $this->__toString();
    }
    
}

?>
