<?php
// src/Remarque/NoteBundle/Entity/RemarqueParticipant.php

namespace Remarque\NoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Remarque\NoteBundle\Entity\RemarqueParticipantRepository")
 */
class RemarqueParticipant
{
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Remarque\NoteBundle\Entity\Remarque")
   */
  private $remarque;

  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Remarque\NoteBundle\Entity\Participant")
   */
  private $participant;

  /**
   * @ORM\Column(type="integer")
   */
  private $vote; // Ici j'ai un attribut de relation « levote »

  // … vous pouvez ajouter d'autres attributs bien entendu
// Getter et setter pour l'entité Remarque
  public function setRemarque(\Remarque\NoteBundle\Entity\Remarque $remarque)
  {
    $this->remarque = $remarque;
  }
  public function getRemarque()
  {
    return $this->remarque;
  }

  // Getter et setter pour l'entité Participant
  public function setParticipant(\Remarque\NoteBundle\Entity\Participant $participant)
  {
    $this->participant = $participant;
  }
  public function getParticipant()
  {
    return $this->participant;
  }


    /**
     * Set vote
     *
     * @param integer $vote
     * @return RemarqueParticipant
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return integer 
     */
    public function getVote()
    {
        return $this->vote;
    }
}
