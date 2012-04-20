<?php
namespace library;

class Encryption
{

    protected $_key = null;

    protected $_iv = null;

    /**
     * Constructor
     * @param $key
     */
    protected function __construct($key)
    {
        $this->_key = $key;
        $this->_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
    }

    /**
     * Get an instance of the Encryption class seeded with a given key
     *
     * @static
     * @param $key
     */
    public static function getInstance($key)
    {
        return new self($key);
    }

    /**
     * Encrypt a given string
     *
     * @param $data
     */
    public function encrypt($data)
    {
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->_key, $data, MCRYPT_MODE_ECB, $this->_iv);
    }

    /**
     * Decrypt a given string
     *
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->_key, $data, MCRYPT_MODE_ECB, $this->_iv);
    }
}