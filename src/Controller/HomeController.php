<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Demande;
use App\Entity\Commande;
use App\Entity\client;
use App\Form\DemandeType;
use App\Form\CommandeType;
use App\Repository\DemandeRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function accueil()
    {
        
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->getUser();
            $client = $user->getClient();
            $genre = $client->getClientGenre();

            return $this->render('home/accueil.html.twig', [
                'genre' => $genre,
                'client' => $client,
            ]);
        }
        return $this->render('home/accueil.html.twig');
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function demande(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->getUser();
            $client = $user->getClient();
            $genre = $client->getClientGenre();

            return $this->render('home/demande.html.twig', [
                'genre' => $genre,
                'client' => $client,
            ]);
        }
        return $this->render('home/demande.html.twig');
            /*$commande = new Commande();
            $form = $this->createForm(CommandeType::class, $commande);
            $commandeForm = $form->createView();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $client = new client();
                $post = $commande;
                $pricetotal = $client->calculerECGAuto($post);
                dump($pricetotal);
                $result = [];
               $this->addFlash('success', 'Le fichier à bien été enregistrée.  ');
               return $this->render('home/demande.html.twig', [
                            'result' => $result,*/
                            /*'pricetotal' => $pricetotal,
                    /*]);
            }

            if ($this->isGranted('IS_AUTHENTICATED_FULLY')){
                    $user = $this->getUser();
                    $client = $user->getClient();
                    $genre = $client->getClientGenre();

                    return $this->render('home/demande.html.twig', [
                            'genre' => $genre,
                            'client' => $client,
                            'commandeForm' => $commandeForm,
                    ]);
            }
            return $this->render('home/demande.html.twig', ['commandeForm' => $commandeForm]);*/
            /*return $this->render('home/demande.html.twig');*/
    }

    /**
     * @Route("/CommentCaMarche", name="CommentCaMarche")
     */
    public function CommentCaMarche()
    {
            if ($this->isGranted('IS_AUTHENTICATED_FULLY')){
                    $user = $this->getUser();
                    $client = $user->getClient();
                    $genre = $client->getClientGenre();

                    return $this->render('home/CommentCaMarche.html.twig', [
                            'genre' => $genre,
                            'client' => $client,
                    ]);
            }
            return $this->render('home/CommentCaMarche.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faq()
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->getUser();
            $client = $user->getClient();
            $genre = $client->getClientGenre();

            return $this->render('home/faq.html.twig', [
                'genre' => $genre,
                'client' => $client,
            ]);
        }
        return $this->render('home/faq.html.twig');
    }

		/**
		 * @Route("/CGV", name="cgv")
		 */
		public function cgv()
		{
				if($this->isGranted('IS_AUTHENTICATED_FULLY')){
						$user = $this->getUser();
						$client = $user->getClient();
						$genre = $client->getClientGenre();

						return $this->render('home/cgv.html.twig', [
								'genre' => $genre,
								'client' => $client,
						]);
				}
				return $this->render('home/cgv.html.twig');
		}

		/**
		 * @Route("/retractation", name="retractation")
		 */
		public function retractation()
		{
				if($this->isGranted('IS_AUTHENTICATED_FULLY')){
						$user = $this->getUser();
						$client = $user->getClient();
						$genre = $client->getClientGenre();

						return $this->render('home/retractation.html.twig', [
								'genre' => $genre,
								'client' => $client,
						]);
				}
				return $this->render('home/retractation.html.twig');
		}

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->getUser();
            $client = $user->getClient();
            $genre = $client->getClientGenre();

            return $this->render('home/contact.html.twig', [
                'genre' => $genre,
                'client' => $client,
            ]);
        }
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/espace", name="espace")
     */
    public function index()
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->getUser();
            $client = $user->getClient();
            $genre = $client->getClientGenre();

            return $this->render('home/index.html.twig', [
                'genre' => $genre,
                'client' => $client,
            ]);
        }
        return $this->render('home/index.html.twig');
    }
	
	/**
    * @Route("/dc", name="dc")
    */
    public function dcdemande(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            $user = $this->getUser();
            $client = $user->getClient();
            $idclient = $client->getId();
            $nom = $client->getClientNom();
            $prenom = $client->getClientPrenom();
            $genre = $client->getClientGenre();
            $dateNaissance = $client->getClientDateNaissance();
            $lieuNaissance = $client->getClientLieuNaissance();
            $dpt = $client->getClientDptNaissance();
            $pays = $client->getClientPaysNaissance();

            $contact = $client->getClientContact();
            $idcontact = $contact->getId();
            $mobile = $contact->getContactTelmobile();
            $mail = $user->getEmail();

        return $this->render('demarche/dc.html.twig', [
                'idclient' => $idclient,
                'mail' => $mail,
                'mobile' => $mobile,
                'pays' => $pays,
                'genre' => $genre,
                'dateN' => $dateNaissance,
                'lieuN' => $lieuNaissance,
                'dptN' => $dpt,
                'client' => $client
        ]); 
    }

    /**
    *@Route("/dc/checkout/{tmsId}", name="checkoutdc")
    */
    public function chekoutDC($tmsId){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $client = $user->getClient();
        $idclient = $client->getId();
        $genre = $client->getClientGenre();
        $demande = $this->getDoctrine()
            ->getRepository(Demande::class)
            ->findOneBy(['client' => $idclient, 'typeDemande' => 'DC', 'TmsIdDemande' => $tmsId]);
            if($demande == NULL){
                return $this->redirectToRoute('dc');
            }
            else{
                $idDemande = $demande->getId();
                return $this->render('demarche/checkout.html.twig',[
                    'idDemande' => $idDemande,
                    'tmsId' => $tmsId,
                    'type' => 'DC',
                    'genre' => $genre,
                    'client' => $client,
                ]);
            }
               
    }


}
