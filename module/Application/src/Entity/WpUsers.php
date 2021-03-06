<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpUsers
 *
 * @ORM\Table(name="wp_users", indexes={@ORM\Index(name="user_login_key", columns={"user_login"}), @ORM\Index(name="user_nicename", columns={"user_nicename"})})
 * @ORM\Entity
 */
class WpUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_login", type="string", length=60, nullable=false)
     */
    private $userLogin = '';

    /**
     * @var string
     *
     * @ORM\Column(name="user_pass", type="string", length=64, nullable=false)
     */
    private $userPass = '';

    /**
     * @var string
     *
     * @ORM\Column(name="user_nicename", type="string", length=50, nullable=false)
     */
    private $userNicename = '';

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=100, nullable=false)
     */
    private $userEmail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="user_url", type="string", length=100, nullable=false)
     */
    private $userUrl = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_registered", type="datetime", nullable=false)
     */
    private $userRegistered = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="user_activation_key", type="string", length=60, nullable=false)
     */
    private $userActivationKey = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_status", type="integer", nullable=false)
     */
    private $userStatus = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=250, nullable=false)
     */
    private $displayName = '';



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userLogin
     *
     * @param string $userLogin
     * @return WpUsers
     */
    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    /**
     * Get userLogin
     *
     * @return string
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * Set userPass
     *
     * @param string $userPass
     * @return WpUsers
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get userPass
     *
     * @return string
     */
    public function getUserPass()
    {
        return $this->userPass;
    }

    public static function hashPassword($user, $pass) {
    	return $user -> getUserPass() == md5($pass);
    }

    /**
     * Set userNicename
     *
     * @param string $userNicename
     * @return WpUsers
     */
    public function setUserNicename($userNicename)
    {
        $this->userNicename = $userNicename;

        return $this;
    }

    /**
     * Get userNicename
     *
     * @return string
     */
    public function getUserNicename()
    {
        return $this->userNicename;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return WpUsers
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userUrl
     *
     * @param string $userUrl
     * @return WpUsers
     */
    public function setUserUrl($userUrl)
    {
        $this->userUrl = $userUrl;

        return $this;
    }

    /**
     * Get userUrl
     *
     * @return string
     */
    public function getUserUrl()
    {
        return $this->userUrl;
    }

    /**
     * Set userRegistered
     *
     * @param \DateTime $userRegistered
     * @return WpUsers
     */
    public function setUserRegistered($userRegistered)
    {
        $this->userRegistered = $userRegistered;

        return $this;
    }

    /**
     * Get userRegistered
     *
     * @return \DateTime
     */
    public function getUserRegistered()
    {
        return $this->userRegistered;
    }

    /**
     * Set userActivationKey
     *
     * @param string $userActivationKey
     * @return WpUsers
     */
    public function setUserActivationKey($userActivationKey)
    {
        $this->userActivationKey = $userActivationKey;

        return $this;
    }

    /**
     * Get userActivationKey
     *
     * @return string
     */
    public function getUserActivationKey()
    {
        return $this->userActivationKey;
    }

    /**
     * Set userStatus
     *
     * @param integer $userStatus
     * @return WpUsers
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;

        return $this;
    }

    /**
     * Get userStatus
     *
     * @return integer
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return WpUsers
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
}
