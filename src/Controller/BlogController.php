<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    private static $POSTS = [
        [
            "id" => 1,
            "slug" => "hello",
            "description" => "Bonjour Abderrazak!"
        ],
        [
            "id" => 2,
            "slug" => "bye",
            "description" => "Bonne soirée Abderrazak!"
        ]
    ];

    /**
     * @Route("/", name="blog_list")
     */
    public function list(Request $request)
    {
        $page = $request->get("page");
        return $this->json(["page" => $page, "data" => array_map(function ($item){
            return $this->generateUrl("blog_post_by_id", ["id" => $item["id"]]);
        }, self::$POSTS)]);
    }

    /**
     * @Route("/{id}", name="blog_post_by_id")
     */
    public function post(Request $request)
    {
        $id = $request->get("id");
        return $this->json(self::$POSTS[array_search($id, array_column(self::$POSTS, "id"))]);
    }

    /**
     * @Route("/{slug}", name="blog_post_by_slug")
     */
    public function post_by_slug($slug)
    {
        return new JsonResponse(self::$POSTS[array_search($slug, array_column(self::$POSTS, "slug"))]);
    }
}