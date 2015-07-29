<?php
// src/Bug.php
/**
 * @Entity(repositoryClass="BugRepository") @Table(name="bugs")
 **/
use Doctrine\Common\Collections\ArrayCollection;
class Bug
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $description;
    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $created;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $status;

    /**
     * @ManyToMany(targetEntity="Product")
     **/
    protected $products = null;
    /**
     * @ManyToOne(targetEntity="User", inversedBy="assignedBugs")
     **/
    protected $engineer;
    /**
     * @ManyToOne(targetEntity="User", inversedBy="reportedBugs")
     **/
    protected $reporter;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function setEngineer($engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function close()
    {
        $this->status = "CLOSE";
    }

    public function setReporter($reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getEngineer()
    {
        return $this->engineer;
    }

    public function getReporter()
    {
        return $this->reporter;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}