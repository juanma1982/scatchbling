<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Backscratcher;

class BackscratcherController extends FOSRestController
{
    
    /**
     * @Rest\Get("/api/backscratcher")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Backscratcher')->findAll();
        if ($restresult === null) {
            return new View("Sorry, there isn't any backscratcher", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
    
    /**
     * @Rest\Get("/api/backscratcher/{id}")
     */
    public function idAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Backscratcher')->find($id);
        if ($singleresult === null) {
            return new View("backscratcher not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }
    
    /**
    * @Rest\Post("/api/backscratcher")
    */
    public function postAction(Request $request)
    {
        $data = new Backscratcher;
        $name = $request->get('name');
        $description = $request->get('description');
        $size = $request->get('size');
        $price = $request->get('price');

        if(empty($name) || empty($price))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setName($name);
        $data->setDescription($description);
        $data->setPrice($price);
        $data->setSize($size);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        
        return new View("Backscratcher Added Successfully", Response::HTTP_OK);
    }
    
    /**
     * @Rest\Put("/api/backscratcher/{id}")
     */
    public function updateAction($id,Request $request)
    {
        $data = new Backscratcher;
        $name = $request->get('name');
        $description = $request->get('description');
        $size = $request->get('size');
        $price = $request->get('price');
        
        $sn = $this->getDoctrine()->getManager();
        $backscratcher = $this->getDoctrine()->getRepository('AppBundle:Backscratcher')->find($id);
        
        if (empty($backscratcher)) {
            return new View("Backscratcher not found", Response::HTTP_NOT_FOUND);
        }
        
        if(!empty($name) && !empty($price)){
            $backscratcher->setName($name);
            $backscratcher->setDescription($description);
            $backscratcher->setSize($size);
            $backscratcher->setPrice($price);
            $sn->flush();
            
            return new View("Backscratcher Updated Successfully", Response::HTTP_OK);
        }
        else return new View("Backscratcher name or price cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }
    
    /**
    * @Rest\Delete("/api/backscratcher/{id}")
    */
    public function deleteAction($id)
    {
        $data = new Backscratcher;
        $sn = $this->getDoctrine()->getManager();
        $backscratcher = $this->getDoctrine()->getRepository('AppBundle:Backscratcher')->find($id);
        if (empty($backscratcher)) {
            return new View("backscratcher not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($backscratcher);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }
}