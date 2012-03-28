<?php 
namespace library\cache;

class Apc extends \library\Cache
{
    
    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        if(!extension_loaded('apc')){
            throw new Exception('APC extension not loaded. Please enable it in php.ini before attempting to use this class');
        }
    }
    
    /**
     * Add a key/value pair to the cache
     * 
     * @param  string  $key
     * @param  mixed[] $value
     * @param  int     $ttl
     * @return bool | array
     */
    public function set($key, $value, $ttl = 0)
    {
        return apc_store($key, $value, $ttl );
    }
    
    /**
     * Remove an existing key from the cache
     * 
     * @param  $key
     * @return bool
     */
    public function delete($key)
    {
        return apc_delete($key);
    }
    
    /**
     * Retrieve an existing item from the cache
     * 
     * @param  string $key
     * @return mixed
     */
    public function get($key)
    {
        $item = apc_fetch($key, $result);
        
        return false === $result ? null : $item;
    }
    
    /**
     * Clear the cache
     * 
     * @return bool
     */
    public function clearCache()
    {
        return apc_clear_cache();
    }
}

?>