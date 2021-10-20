<?php
namespace App\Controller; 

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropertyRepository; 


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
    public function index(): Response
    {    
        $property = $this->repository->findAllVisible();
        dump($property);
        return $this->render('property/index.html.twig');
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