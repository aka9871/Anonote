<?php
// src/Remarque/NoteBundle/DataFixtures/ORM/Participants.php

namespace Remarque\NoteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Remarque\NoteBundle\Entity\Participant;

class Participants implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Liste des noms de compétences à ajouter
    $emails = array('participant1@gmail.com', 'participant2@gmail.com', 'participant3@gmail.com');

    foreach($emails as $i => $emailParticipant)
    {
      // On crée la compétence
      $liste_participants[$i] = new Participant();
      $liste_participants[$i]->setEmailParticipant($emailParticipant);

      // On la persiste
      $manager->persist($liste_participants[$i]);
    }                            

    // On déclenche l'enregistrement
    $manager->flush();
  }
}
