<?php
// Remarque/NoteBundle/Entity/Participant.php

namespace Remarque\NoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Remarque\NoteBundle\Entity\Participant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Remarque\NoteBundle\Entity\ParticipantRepository")
 */
class Participant
{
  /**
    * @var integer $id
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
  private $id;

    /**
    * @var string $emailParticipant
    *
    * @ORM\Column(name="email_participant", type="string", length=255)
    */
  private $emailParticipant;


    

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
     * Set emailParticipant
     *
     * @param string $emailParticipant
     * @return Participant
     */
    public function setEmailParticipant($emailParticipant)
    {
        $this->emailParticipant = $emailParticipant;

        return $this;
    }

    /**
     * Get emailParticipant
     *
     * @return string 
     */
    public function getEmailParticipant()
    {
        return $this->emailParticipant;
    }
}
