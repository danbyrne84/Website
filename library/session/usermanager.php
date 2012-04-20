<?php

namespace library\session;

/**
 * Class to handle user objects in a session
 */
class UserManager
{
    /**
     * User types
     */
    const USERMANAGER_TYPE_USER = 'user';
    const USERMANAGER_TYPE_ADMIN = 'admin';

    /**
     * Collection of user objects
     *
     * @var array
     */
    protected $_users = array();

    /**
     * Retrieve an instance of this class
     *
     * @static
     * @return UserManager
     */
    public static function getInstance()
    {
        if(!isset( $_SESSION['UserManager'] ) )
        {
            $userManager = new self();
            $_SESSION['UserManager'] = $userManager;
        }

        return $_SESSION['UserManager'];
    }

    protected function __construct()
    {

    }

    /**
     * Set a user object of the given user type
     *
     * @param $userType
     * @param $obj
     */
    public function setUser($userType, $obj)
    {
        $this->_users[$userType] = $obj;
    }

    /**
     * Log out the given user type
     *
     * @param $userType
     */
    public function logout($userType)
    {
        unset( $this->_users[$userType] );
    }

    /**
     * Retrieve a user object of the given type
     *
     * @param $userType
     * @param $required throw an exception if the user is not present
     * @return library\User
     */
    public function getUser($userType, $required)
    {
        $user = isset( $this->_users[$userType] ) ? $this->_users[$userType] : null;

        if( null === $user )
        {
            throw new usermanager\LoginRequiredException('You must be logged in as a ' . $userType);
        }

        return $user;

    }

    /**
     * Check if a user is logged in
     *
     * @return bool
     */
    public function isLoggedIn($userType = null)
    {
        if( $userType == null ){
            return count($this->_users) > 0;
        }
        else
        {
            return isset($this->_users[$userType]);
        }
    }

}
