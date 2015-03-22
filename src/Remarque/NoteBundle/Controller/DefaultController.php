<?php

namespace Remarque\NoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RemarqueNoteBundle:Default:index.html.twig');
    }
    
}
