<?php

// src/AppBundle/Controller/ApiController.php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiController extends FOSRestController
{
    /**
     * Returns list of all posts from ImageThread
     *
     * @ApiDoc(
     *   resource=true,
     *   description="Returns JSON formatted total number of posts"
     * )
     * 
     * @Get("/posts")
     */
    public function postsAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findBy(array(), array('date' => 'desc'));

        $data = array("posts" => $posts);
        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * Returns total number of posts from ImageThread
     *
     * @ApiDoc(
     *   resource=true,
     *   description="Returns JSON formatted total number of posts"
     * )
     *
     * @Get("/total-number-of-posts")
     */
    public function totalNumberOfPostsAction()
    {
        $totalNumberOfPosts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->getTotalNumberOfPosts();

        $data = array("totalNumberOfPosts" => $totalNumberOfPosts);
        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * Returns total number of views from ImageThread
     *
     * @ApiDoc(
     *   resource=true,
     *   description="Returns JSON formatted total number of views"
     * )
     *
     * @Get("/total-number-of-views")
     */
    public function totalNumberOfViewsAction()
    {
        $totalNumberOfViews = $this->getDoctrine()
            ->getRepository('AppBundle:Analytics')
            ->getUpdatedTotalNumberOfViews();

        $data = array("totalNumberOfViews" => $totalNumberOfViews);
        $view = $this->view($data);
        return $this->handleView($view);
    }
}
