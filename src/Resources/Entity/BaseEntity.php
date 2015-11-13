<?php
namespace Resources\Entity;

use DateTime;

/**
 * Class BaseEntity.
 */
abstract class BaseEntity
{
    /** @var int|guid */
    protected $id;

    /** @var DateTime */
    protected $createdAt;

    /** @var DateTime */
    protected $updatedAt;

    /**
     * Get id.
     *
     * @return int|guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt.
     *
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /** PrePersist hook to set createdAt & updatedAt when creating entity. */
    public function doCreatedValue()
    {
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());
    }

    /** PreUpdate hook to set updatedAt property on every save. */
    public function doUpdatedValue()
    {
        $this->setUpdatedAt(new DateTime());
    }

    /** @return string */
    public function __toString()
    {
        return $this->getId();
    }
}
