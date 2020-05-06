<?php

namespace App\Controller;


use App\Entity\BlogPost as BlogPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/posts", name="blog_list", methods={"GET"})
     */
    public function list(Request $request)
    {
        $page = $request->get("page");
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
        $posts = $repository->findAll();
        return $this->json(["page" => $page, "data" => array_map(function (BlogPost $item){
            return $this->generateUrl("blog_post_by_slug", ["slug" => $item->getSlug()]);
        }, $posts)]);
    }

    /**
     * @Route("/posts/{id}", name="blog_post_by_id", methods={"GET"}, requirements={"id":"\d+"})
     * @ParamConverter("post", class="App:BlogPost")
     */
    public function post($post)
    {
        return $this->json($post);
    }

    /**
     * @Route("/posts/{slug}", name="blog_post_by_slug", methods={"GET"})
     * @ParamConverter("post", class="App:BlogPost", options={"mapping": {"slug":"slug"}})
     */
    public function postBySlug($post)
    {
        //$post = $this->getDoctrine()->getRepository(BlogPost::class)->findOneBy(["slug" => $slug]);
        return $this->json($post);
    }

    /**
     * @Route("/posts", name="blog_add", methods={"POST"})
     */
    public function add(Request $request)
    {
        $serializer = $this->get("serializer");
        $blogPost = $serializer->deserialize($request->getContent(), BlogPost::class, 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($blogPost);
        $em->flush();
        return $this->json($blogPost);
    }

    /**
     * @Route("/posts/{id}", name="blog_delete", methods={"DELETE"})
     */
    public function delete(BlogPost $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}