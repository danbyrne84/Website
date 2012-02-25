<?php 
namespace library;

abstract class Cache
{
	public abstract function set($key, $val, $ttl = 0);
	public abstract function delete($key);
	public abstract function get($key);
	public abstract function clearCache();
}

?>