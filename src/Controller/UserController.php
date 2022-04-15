<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class UserController extends AbstractController
{

    /**
     * @Route("api/users.{format}", name="search", methods={"GET"})
     */
    public function search(UserRepository $userR, SerializerInterface $serializer, Request $request): Response
    {
        try{
            $params = $request->query->all();
            $data = User::getSearch($userR,$params);
            $format = $request->get('format', "json");
            
            foreach ($data as $row) {
                $v = $serializer->normalize($row, null, ['groups' => 'User:exo2']);
                $v['login']['passwordStrength'] = User::calculatePassStrength($v['login']['password']);
                $val[] = $v;
            }
            if ($format == 'xml') {
                $response = new Response($serializer->serialize($val, 'xml'), 200);
                $response->headers->set('Content-Type', 'text/xml');
            } else if($format == 'json') {
                $response = $this->json($val, 200);
                $response->headers->set('Content-Type', 'text/json');
            }else{
                return $this->json('format invalid', 500);
            }
            return $response;
        }
        catch(Exception $e){
            return $this->json('une erreur est survenu', 500);
        }
    }

     /**
     * @Route("/api/users/import", name="import_randomuser", methods={"GET"})
     */
    public function import_randomuser(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        try{
            //parametre par defaut de randomuser 
            $seed =  $request->get('seed', "tsiky");
            $nat = $request->get('nat', "FR");
            $results = $request->get('count', 500);

            //lien pour prendre les donnees json
            $url = "https://randomuser.me/api/1.2/?seed=" . $seed . "&nat=" . $nat . "&results=" . $results;
            $json = file_get_contents($url);
            $data = json_decode($json);
            
            //donnée a entrer dans le database 
            $val = $serializer->deserialize(json_encode($data->results), User::class . '[]', 'json');

            //sauvegarde dans database
            foreach ($val as $row) {
                $em->persist($row);
            }
            $em->flush();
            return $this->json(['data' => $data],202);
        } catch (Exception $e) {
            return $this->json('une erreur est survenu', 500);
        }
    }

    /**
     * @Route("api/users.{format}/{uuid}", name="get_by_uuid", methods={"GET"})
     */
    public function getByUuid($uuid, UserRepository $userR, SerializerInterface $serializer, Request $request): Response
    {
        try{
           // format par defaut
           $format =  $request->get('format', 'json');

            $val = $userR->getByUuid($uuid);
            $val = $serializer->normalize($val[0],null, ['groups' => 'User:exo4']);


           $val['login']['passwordStrength'] = User::calculatePassStrength($val['login']['password']);

            if($format == 'xml'){
                $response = new Response($serializer->serialize($val, 'xml'));
                $response->headers->set('Content-Type', 'text/xml');
            } else if ($format == 'json') {
                $response = $this->json($val, 200);
            } else {
                return $this->json('format invalid', 500);
            } 
            return $response;
        
        } catch (Exception $e) {
            return $this->json('une erreur est survenu', 500);
        }
    }
}