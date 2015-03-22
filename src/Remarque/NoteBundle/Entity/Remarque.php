<?php
// src/Sdz/BlogBundle/Entity/Remarque.php
namespace Remarque\NoteBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
/**
 * Remarque\NoteBundle\Entity\Remarque
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Remarque\NoteBundle\Entity\RemarqueRepository")
 */
class Remarque
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
    * @ORM\Column(name="titre", type="string", length=255)
    */
    private $titre;

    /**
    * @ORM\Column(name="Contenu", type="text")
    */
    private $contenu;
    /**
    * @ORM\Column(name="auteur", type="string", length=255)
    */
    private $auteur;

    /**
    * @var string $email
    *
    * @ORM\Column(name="email", type="string", length=255)
    */
    private $email;


    private $participants;


    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

   

    public function getParticipants()
    {
        return $this->participants;
    }

    public function setParticipants(ArrayCollection $participants)
    {
        $this->participants = $participants;
    }
  
  // Vos autres getters/setters…

  

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
     * Set titre
     *
     * @param string $titre
     * @return Remarque
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Remarque
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Remarque
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Remarque
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
}
