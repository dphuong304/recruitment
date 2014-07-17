<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpPosts
 *
 * @ORM\Table(name="wp_posts", indexes={@ORM\Index(name="post_name", columns={"post_name"}), @ORM\Index(name="type_status_date", columns={"post_type", "post_status", "post_date", "ID"}), @ORM\Index(name="post_parent", columns={"post_parent"}), @ORM\Index(name="post_author", columns={"post_author"})})
 * @ORM\Entity
 */
class WpPosts
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
     * @var integer
     *
     * @ORM\Column(name="post_author", type="bigint", nullable=false)
     */
    private $postAuthor = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date", type="datetime", nullable=false)
     */
    private $postDate = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="post_content", type="text", nullable=false)
     */
    private $postContent;

    /**
     * @var string
     *
     * @ORM\Column(name="post_title", type="text", nullable=false)
     */
    private $postTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_excerpt", type="text", nullable=false)
     */
    private $postExcerpt;

    /**
     * @var string
     *
     * @ORM\Column(name="post_status", type="string", length=20, nullable=false)
     */
    private $postStatus = 'publish';

    /**
     * @var string
     *
     * @ORM\Column(name="post_name", type="string", length=200, nullable=false)
     */
    private $postName = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_modified", type="datetime", nullable=false)
     */
    private $postModified = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="post_parent", type="bigint", nullable=false)
     */
    private $postParent = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=255, nullable=false)
     */
    private $guid = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="menu_order", type="integer", nullable=false)
     */
    private $menuOrder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="post_type", type="string", length=20, nullable=false)
     */
    private $postType = 'post';

    /**
     * @var string
     *
     * @ORM\Column(name="post_mime_type", type="string", length=100, nullable=true)
     */
    private $postMimeType = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_count", type="bigint", nullable=false)
     */
    private $commentCount = '0';



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
     * Set postAuthor
     *
     * @param integer $postAuthor
     * @return WpPosts
     */
    public function setPostAuthor($postAuthor)
    {
        $this->postAuthor = $postAuthor;

        return $this;
    }

    /**
     * Get postAuthor
     *
     * @return integer 
     */
    public function getPostAuthor()
    {
        return $this->postAuthor;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return WpPosts
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set postContent
     *
     * @param string $postContent
     * @return WpPosts
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Get postContent
     *
     * @return string 
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set postTitle
     *
     * @param string $postTitle
     * @return WpPosts
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return string 
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postExcerpt
     *
     * @param string $postExcerpt
     * @return WpPosts
     */
    public function setPostExcerpt($postExcerpt)
    {
        $this->postExcerpt = $postExcerpt;

        return $this;
    }

    /**
     * Get postExcerpt
     *
     * @return string 
     */
    public function getPostExcerpt()
    {
        return $this->postExcerpt;
    }

    /**
     * Set postStatus
     *
     * @param string $postStatus
     * @return WpPosts
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return string 
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Set postName
     *
     * @param string $postName
     * @return WpPosts
     */
    public function setPostName($postName)
    {
        $this->postName = $postName;

        return $this;
    }

    /**
     * Get postName
     *
     * @return string 
     */
    public function getPostName()
    {
        return $this->postName;
    }

    /**
     * Set postModified
     *
     * @param \DateTime $postModified
     * @return WpPosts
     */
    public function setPostModified($postModified)
    {
        $this->postModified = $postModified;

        return $this;
    }

    /**
     * Get postModified
     *
     * @return \DateTime 
     */
    public function getPostModified()
    {
        return $this->postModified;
    }

    /**
     * Set postParent
     *
     * @param integer $postParent
     * @return WpPosts
     */
    public function setPostParent($postParent)
    {
        $this->postParent = $postParent;

        return $this;
    }

    /**
     * Get postParent
     *
     * @return integer 
     */
    public function getPostParent()
    {
        return $this->postParent;
    }

    /**
     * Set guid
     *
     * @param string $guid
     * @return WpPosts
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * Get guid
     *
     * @return string 
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Set menuOrder
     *
     * @param integer $menuOrder
     * @return WpPosts
     */
    public function setMenuOrder($menuOrder)
    {
        $this->menuOrder = $menuOrder;

        return $this;
    }

    /**
     * Get menuOrder
     *
     * @return integer 
     */
    public function getMenuOrder()
    {
        return $this->menuOrder;
    }

    /**
     * Set postType
     *
     * @param string $postType
     * @return WpPosts
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;

        return $this;
    }

    /**
     * Get postType
     *
     * @return string 
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set postMimeType
     *
     * @param string $postMimeType
     * @return WpPosts
     */
    public function setPostMimeType($postMimeType)
    {
        $this->postMimeType = $postMimeType;

        return $this;
    }

    /**
     * Get postMimeType
     *
     * @return string 
     */
    public function getPostMimeType()
    {
        return $this->postMimeType;
    }

    /**
     * Set commentCount
     *
     * @param integer $commentCount
     * @return WpPosts
     */
    public function setCommentCount($commentCount)
    {
        $this->commentCount = $commentCount;

        return $this;
    }

    /**
     * Get commentCount
     *
     * @return integer 
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }
}
