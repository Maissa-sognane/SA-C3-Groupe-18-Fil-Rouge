<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprenantController extends AbstractController
{
    /**
     * @Route(name="apprenant_liste",
     * path="api/apprenants",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showApprenant",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_apprenants"
     * }
     * )
     * @param UserRepository $repo
     * @return JsonResponse
     */
    public function showApprenant(UserRepository $repo)
    {
        $apprenants = $repo->findByProfil('apprenant');
        return $this->json($apprenants, Response::HTTP_OK);
    }

    /**
     * @Route(name="apprenant_liste",
     * path="api/apprenants/id",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showApprenantBy",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_apprenants"
     * }
     * )
     * @param UserRepository $repo
     * @return JsonResponse
     */
    public function showApprenantBy(UserRepository $repo)
    {
        $apprenants = $repo->findByProfil('apprenant');
        return $this->json($apprenants, Response::HTTP_OK);
    }


}
