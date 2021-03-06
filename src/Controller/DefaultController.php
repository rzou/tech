<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(
            [
                "action" => "index",
                "time" => time()
            ]
        );
    }
}