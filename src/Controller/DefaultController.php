<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function home()
    {
        return $this->render('default/index.html.twig', [
            'title' => 'homepage',
        ]);

         
    }

    /**
     * @Route("/add-resource", name="add_resource", methods={"POST"})
     */
    public function add_resource(Request $request)
    {   
        // $entityManager = $this->getDoctrine()->getManager();

        // $resource = new Resource();
        // $resource->setValue('Sample Value');
        // $resource->setNumber(rand('1', '200'));
        
        // // tell Doctrine you want to (eventually) save the Product (no queries yet)
        // $entityManager->persist($resource);

        // // actually executes the queries (i.e. the INSERT query)
        // $entityManager->flush();

        

       

        // return $this->render('default/add.html.twig', [
        //     'title' => 'add resource',
        // ]);
        var_dump($request);
        exit('test');



        
    }

    /**
     * @Route("/database", name="database")
     */
    public function database()
    {   
        $repository = $this->getDoctrine()->getRepository(Resource::class);
        $resources = $repository->findAll();


        return $this->render('default/database.html.twig', [
            'title' => 'database',
            'resources' => $resources
        ]);

        
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Request $request)
    {   
         
        $repository = $this->getDoctrine()->getRepository(Resource::class);

        
        $id = $request->attributes->get('id');
         
        
  
       
        $resource =  $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($resource);
        $entityManager->flush();

        return $this->render('default/delete.html.twig', [
            'title' => 'delete', 
            'id' => $id
        ]);

        
    }

    public function getId(){

        $id = 120;

        return $id;
    }
}
