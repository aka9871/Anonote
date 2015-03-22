<?php
// src/Remarque/NoteBundle/Controller/RemarqueController.php


namespace Remarque\NoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

use Remarque\NoteBundle\Entity\RemarqueParticipant;
use Remarque\NoteBundle\Entity\Remarque;
use Remarque\NoteBundle\Form\RemarqueType;

class RemarqueController extends Controller
{

  // …

  public function ajouterAction(Request $request)
  {
    // On récupére l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();

    // Création de l'entité Remarque
    $remarque = new Remarque();
    $form = $this->createForm(new RemarqueType(), $remarque);

    if ($request->isMethod('POST')) 
        {     
            $form->handleRequest($request);
            
            
           if ($form->isValid()) 
           {

             // $remarque->setTitre('Mon dernier weekend');
             // $remarque->setContenu("C'était vraiment super et on s'est bien amusé.");
             // $remarque->setAuteur('winzou');
             $remarque->setAuteur($this->getUser()->getEmail());
             
            // Dans ce cas, on doit créer effectivement la remarque en bdd pour lui assigner un id
            // On doit faire cela pour pouvoir enregistrer les RemarqueParticipant par la suite

             $em->persist($remarque);
             $em->flush(); // Maintenant, $remarque a un id défini
            

             $liste_participants=$remarque->getParticipants();

            //  // Pour chaque participant
            foreach($liste_participants as $i => $participant)
            {

                
                // On crée une nouvelle « relation entre 1 article et 1 compétence »
                $remarqueParticipant[$i] = new RemarqueParticipant;

                // On la lie à la remarque, qui est ici toujours le même
                $remarqueParticipant[$i]->setRemarque($remarque);

               $recherche = $em->getRepository('RemarqueNoteBundle:Participant')
                           ->findOneByemailParticipant($participant->getEmailParticipant());   

               

               if($recherche)
                {
                  $em->persist($recherche);
                  $em->flush();
                  // On la lie au participant deja trouvé, qui change ici dans la boucle foreach
                $remarqueParticipant[$i]->setParticipant($recherche);

                }
               else 
                {
                  $em->persist($participant);
                  $em->flush();
                  // On la lie au nouveau participant, qui change ici dans la boucle foreach
                  $remarqueParticipant[$i]->setParticipant($participant);

                }


                // On dit que chaque participant n'a pas encoré voté
                 $remarqueParticipant[$i]->setVote(0);     
                // Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
                $em->persist($remarqueParticipant[$i]);
            }
             $em->flush();
             
           }

            $url = $this->get('router')->generate(
           'Voir_remarque', // 1er argument : le nom de la route
           array('id' => $remarque->getId())    // 2e argument : les valeurs des paramètres
       );
          
          return $this->redirect($url);
        }

     return $this->render('RemarqueNoteBundle:Note:new.html.twig', array(
            'form' => $form->createView(),
        ));


    
  }

 public function voirAction($id)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();

    // On récupère l'entité correspondant à l'id $id
    $remarque = $em->getRepository('RemarqueNoteBundle:Remarque')
                  ->find($id);

    if ($remarque === null) {
      throw $this->createNotFoundException('Remarque[id='.$id.'] inexistant.');
    }

    // On récupère les articleParticipant pour la remarque $remarque
    $liste_remarqueParticipant = $em->getRepository('RemarqueNoteBundle:RemarqueParticipant')
                            ->findByRemarque($remarque->getId());
     
     // ICI EST LE COEUR DE L'APPLICATION, LE CONCEPT DE L'ANONYMAT 
     
     $pas_vote=$vote_positif=$vote_negatif=$signal=0;

     foreach ($liste_remarqueParticipant as $compteur=> $Participant) {
      
      $levote=$Participant->getVote();
      if($levote==0)
      {
      $pas_vote++;
      }
      elseif ($levote==1) {
          $vote_positif++; 
         }  
         elseif ($levote==2) {
           $vote_negatif++;
         }
             else{
              $signal++;
             }
      
     }
     
     dump($this->container, $compteur+1);


    // Puis modifiez la ligne du render comme ceci, pour prendre en compte les articleParticipant :
    return $this->render('RemarqueNoteBundle:Blog:voir.html.twig', array(
      'remarque' => $remarque,
      'nbr_participant' => $compteur+1,
      'pas_vote' => $pas_vote,
      'vote_positif' => $vote_positif,
      'vote_negatif' => $vote_negatif,
      'signal' => $signal,
      //'liste_remarqueParticipant'  => $liste_remarqueParticipant,
      // … et évidemment les autres variables que vous pouvez avoir
    ));
  }

  public function dashboardAction()
  {

   // On récupère l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();

    $remarque_envoyee= $em->getRepository('RemarqueNoteBundle:Remarque')
                  ->findByAuteur($this->getUser()->getEmail());  

    $mes_remarques = $em->getRepository('RemarqueNoteBundle:Remarque')
                  ->findByEmail($this->getUser()->getEmail()); 

    $moi_participant= $em->getRepository('RemarqueNoteBundle:Participant')
                  ->findOneByemailParticipant($this->getUser()->getEmail());

   

    $mes_votes=$em->getRepository('RemarqueNoteBundle:RemarqueParticipant')
               ->findByParticipant($moi_participant->getId());
                dump($this->container, $mes_votes);

   return $this->render('RemarqueNoteBundle:Note:dash.html.twig', array(
            'remarque_envoyee' => $remarque_envoyee,
            'mes_remarques' => $mes_remarques,
            'mes_votes' => $mes_votes,
        ));


  }


}