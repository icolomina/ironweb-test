<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @ORM\Table(name="article")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @JMS\Expose
     * @JMS\Groups({"created", "answered", "rated", "shown"})
     */
    protected $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @JMS\Expose
     * @JMS\Groups({"created", "shown"})
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @JMS\Expose
     * @JMS\Groups({"created", "shown"})
     *
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     *
     * @JMS\Expose
     * @JMS\Groups({"shown"})
     *
     * @Assert\NotBlank
     */
    protected $description;

    /**
     * @ORM\Column(type="text")
     *
     * @JMS\Expose
     * @JMS\Groups({"shown"})
     *
     * @Assert\NotBlank
     */
    protected $text;

    /**
     * @ORM\OneToMany(targetEntity="ArticleAnswer", mappedBy="article")
     *
     * @JMS\Expose
     * @JMS\Groups({"shown"})
     */
    protected $answers;

    /**
     * @ORM\OneToMany(targetEntity="ArticleRate", mappedBy="article")
     */
    protected $rates;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rates = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set email
     *
     * @param string $email
     *
     * @return Article
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Article
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Add answer
     *
     * @param \AppBundle\Entity\ArticleAnswer $answer
     *
     * @return Article
     */
    public function addAnswer(\AppBundle\Entity\ArticleAnswer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \AppBundle\Entity\ArticleAnswer $answer
     */
    public function removeAnswer(\AppBundle\Entity\ArticleAnswer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add rate
     *
     * @param \AppBundle\Entity\ArticleRate $rate
     *
     * @return Article
     */
    public function addRate(\AppBundle\Entity\ArticleRate $rate)
    {
        $this->rates[] = $rate;

        return $this;
    }

    /**
     * Remove rate
     *
     * @param \AppBundle\Entity\ArticleRate $rate
     */
    public function removeRate(\AppBundle\Entity\ArticleRate $rate)
    {
        $this->rates->removeElement($rate);
    }

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRates()
    {
        return $this->rates;
    }

}
