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
        $entityManager = $this->getDoctrine()->getManager();

        $resource = new Resource();

      
        $value = $request->request->get('stringValue');
        $number = $request->request->get('numberInput');

        $resource->setValue($value);
        $resource->setNumber($number);

 
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($resource);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        

       

        return $this->render('default/add.html.twig', [
            'title' => 'add resource',
        ]);
       



        
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
     * @Route("/toedit/{id}", name="toedit")
     */
    public function toEdit(Request $request)
    {   
         
        $repository = $this->getDoctrine()->getRepository(Resource::class);

        
        $id = $request->attributes->get('id');
         
        
  
       
        $resource =  $repository->find($id);

        // $entityManager = $this->getDoctrine()->getManager();

        // $entityManager->remove($resource);
        // $entityManager->flush();

        return $this->render('default/to-edit.html.twig', [
            'title' => 'edit', 
            'id' => $id,
            'resource' => $resource
        ]);

        
    }

    /**
     * @Route("/edit-resource/{id}", name="edit-resource")
     */
    public function editresource(Request $request)
    {   
        $repository = $this->getDoctrine()->getRepository(Resource::class);
        $id = $request->attributes->get('id');
        $resource =  $repository->find($id);

       

        $newValue = $request->request->get('stringValue');
        $newNumber = $request->request->get('numberInput');

        $resource->setValue($newValue);
        $resource->setNumber($newNumber);

        $entityManager = $this->getDoctrine()->getManager();
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($resource);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

   

        return $this->render('default/edited.html.twig', [
            'title' => 'homepage',
            'id' => $id
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

     
    // /**
    //  * @Route("/login", name="login")
    //  */
    // public function login()
    // {   
        
    //     return $this->render('login/login.html.twig', [
    //         'title' => 'loginForm',
    //     ]);

         
    // }

    // /**
    //  * @Route("/try-login", name="try-login")
    //  */
    // public function trylogin()
    // {   
        
    //     die('attempting login...');
        
         
    // }

    




}