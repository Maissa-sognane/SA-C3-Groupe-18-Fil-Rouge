<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @Route(name="apprenant",
     * path="api/apprenants/{id}",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showApprenantBy",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_apprenants_by_Id"
     * }
     * )
     * @param UserRepository $repo
     * @param $id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function showApprenantBy(UserRepository $repo, $id, SerializerInterface $serializer)
    {
        $apprenants = $repo->findByProfil('apprenant');
       if($apprenants[0]->getId() == $id){
           return $this->json($apprenants, Response::HTTP_OK);
       }
       else{
           return $this->json("Pas trouvé", Response::HTTP_NOT_FOUND);
       }
    }

    /**
     * @Route(name="formateur_liste",
     * path="api/formateurs",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showFormateur",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_formateurs"
     * }
     * )
     * @param UserRepository $repo
     * @return JsonResponse
     */
    public function showFormateur(UserRepository $repo)
    {
        $formateurs = $repo->findByProfil('formateur');
        return $this->json($formateurs, Response::HTTP_OK);
    }


    /**
     * @Route(name="formateur_liste",
     * path="api/formateurs/{id}",
     * methods={"GET"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::showFormateurBy",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="get_formateurs_by_Id"
     * }
     * )
     * @param UserRepository $repo
     * @param $id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function showFormateurBy(UserRepository $repo, $id, SerializerInterface $serializer)
    {
        $formateurs = $repo->findByProfil('formateur');
        if($formateurs[0]->getId() == $id){
            return $this->json($formateurs, Response::HTTP_OK);
        }
        else{
            return $this->json("Pas trouvé", Response::HTTP_NOT_FOUND);
        }
    }


}
