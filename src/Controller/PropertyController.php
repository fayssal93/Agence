<?php
namespace App\Controller; 

use App\Entity\Property;
use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Repository\PropertyRepository; 
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController {

   /**
    * @var PropertyRepository
    */
    private $repository; 

    public function __construct(PropertyRepository $repository)
   {
       $this->repository = $repository; 
   }
   
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index( PaginatorInterface $paginator, Request $request): Response
    {     
       // Créer une entité qui va représenter notre recherche prix max, nbr de pièces max, 
       $recherche = new Recherche(); 

       // créer un forumalaire 
       $form = $this->createForm(RechercheType::class, $recherche );

       // Gérer le traitement dans le controller
       $form->handleRequest($request);
      
       $properties = $paginator->paginate(
        $this->repository->findAllVisible($recherche),
        $request->query->getInt('page', 1), /*page number*/
        12  /*limit per page*/
        );

        

        return $this->render('property/index.html.twig', [
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug){
            //redirection
            $this->redirectToRoute('property.show', [
                'id' => $property->getId(), 
                'slug' => $property->getSlug()
            ], 301);
        } 
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }

}