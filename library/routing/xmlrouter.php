<?php
namespace library\routing;

/**
 * Route an incoming request and map it to an XML file of valid routes
 * 
 * @author Dan Byrne <daniel.byrne@gmail.com>
 */
class XmlRouter extends \library\Router
{
    /**
     * Routing data
     * 
     * @var string $_data;
     */
    protected $_data;
    
    /**
     * Constructor
     * 
     * @param string $file path to the routing configuration
     */
    public function __construct($file)
    {
        $document = \DomDocument::load($file);

        if(false === $document){
            throw new RoutingException('Unable to load routing XML [' . $file . ']');
        }
        
        $this->_data = $document;
    }
    
    /**
     * Find a route element for a given request
     * 
     * @param string $request
     * @return \DomNode | false
     */
    protected function _findRoute($xpath, $request)
    {
        $path = explode('/', $request);
        $query = '/routes';

        // filter out leading and trailing slashes
        $path = array_filter($path, function($part){
            if(!empty($part)){
                return true;
            }
        });
        
        // build xpath query, or retrieve default route
        if(count($path) > 0)
        {
            foreach($path as $part)
            {
                // if current path exists and has a query parameter ignore the next part
                if( $query !== null ){
                    $curRoute = $xpath->query($query);

                    $result = $curRoute->item(0)->parentNode;
                    $param = $xpath->query('params/param', $curRoute->item(0));

                    if ($param->length > 0)
                    {
                        //@todo data layer & dedup query
                        $paramName = $param->item(0)->nodeValue;
                        $_GET[$paramName] = $part;
                    }
                    else
                    {
                        $query .= '/route/url[text()="' . $part . '"]/..';
                    }
                }
                else
                {
                    $query .= '/route/url[text()="' . $part . '"]/..';
                }
            }
        }
        else
        {
            $query .= '/route/url[text()]/..';
        }

        // locate the page
        $route = $xpath->query($query);

        if (0 === $route->length){
            $route = $xpath->query('/routes/route/url[text()="__404__"]');
        }
        
        return (0 === $route->length) ? false : $route->item(0);
    }
    
    /**
     * Route a given request
     * 
     * @param string $request
     */
    public function route($request, $throw = false)
    {
        $xpath = new \DOMXPath($this->_data);
        $route = $this->_findRoute($xpath, $request);
        
        if (false === $route){
            if (true === $throw) {
                throw new RoutingException('No route found for URI [' . $request . ']');
            }
            die('request' . $request);
            header('HTTP/1.0 404 Not Found');
            exit(0);
        }
        
        // retrieve the controller and action
        $controllerNode = $xpath->query('params/controller', $route);
        $actionNode = $xpath->query('params/action', $route);
        
        $controller = $controllerNode->item(0)->nodeValue;
        $action = $actionNode->item(0)->nodeValue;
        
        $controllerString = '\\controllers\\' . $controller;
        
        // check that the controller exists and there is a valid method on it to dispatch to
        if(!class_exists($controllerString)){
            throw new RoutingException('No controller [' . $controllerString . '] found');  
        }

        $controller = new $controllerString();

        if(!method_exists($controller, $action)){
            throw new RoutingException('No action [' . $action . '] found in controller [' . $controllerString . ']');
        }

        // dispatch
        $controller->$action();
    }
}

?>