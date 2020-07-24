<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * @Route(name="addUser",
     * path="api/users",
     * methods={"POST"},
     * defaults={
     * "_controller"="\app\ControllerApprenantController::addUser",
     * "_api_resource_class"=User::class,
     * "_api_collection_operation_name"="post_users"
     * }
     * )
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param SerializerInterface $serializer
     * @param UserPasswordEncoderInterface $encoder
     * @param ProfilRepository $repository
     * @param EntityManagerInterface $manager
     * @return JsonResponse
     */

    public function addUser(Request $request, ValidatorInterface $validator,
                            SerializerInterface $serializer,UserPasswordEncoderInterface $encoder,
                            ProfilRepository $repository, EntityManagerInterface $manager){
        $usersJson= $request->request->all();
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(),"rb");
        $usersJson['avatar'] = $avatar;

        $usersTab = $serializer->denormalize($usersJson, "App\Entity\User");

        $errors = $validator->validate($usersTab);

        if (count($errors) > 0) {
            $errorsString =$serializer->serialize($errors,"json");
            return new JsonResponse( $errorsString ,Response::HTTP_BAD_REQUEST,[],true);
        }
        $password = $usersTab->getPassword();
        $usersTab->setPassword($encoder->encodePassword($usersTab, $password));
        $manager->persist($usersTab);
        $manager->flush();
        fclose($avatar);

        return $this->json($usersTab,Response::HTTP_CREATED);
    }
}
