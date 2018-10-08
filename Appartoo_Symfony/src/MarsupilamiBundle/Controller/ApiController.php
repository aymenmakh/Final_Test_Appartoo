<?php
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 04/10/2018
 * Time: 20:42
 */

namespace MarsupilamiBundle\Controller;

use MarsupilamiBundle\Entity\Marsupilami;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations

class ApiController extends Controller
{
    /**
     * ApiController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @Rest\View()
     * @Rest\Get("/places/{id}")
     *
     */

    public function getAction($id)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id);
        $data =$this->get('jms_serializer')->serialize($user,'json');
        return new JsonResponse(json_decode($data),Response::HTTP_ACCEPTED);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/places")
     *
     */

    public function getAllAction()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        $em = $this->getDoctrine()->getManager();
        $all=$em->getRepository("MarsupilamiBundle:Marsupilami")->findAll();
        $data =$this->get('jms_serializer')->serialize($all,'json');
        return new JsonResponse(json_decode($data),Response::HTTP_ACCEPTED);
    }


    /**
     * @Rest\View()
     * @Rest\Get("/api/{login}/{password}")
     *
     *
     */
    function loginRestAction(Request $request,$login,$password){
       /* $login = $request->get('login');
        $password = $request->get('password');*/

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        $em = $this->getDoctrine()->getManager();
        $user=null;
        // $hashed_pwd = password_hash($password,PASSWORD_DEFAULT);
        $user= $em->getRepository('MarsupilamiBundle:Marsupilami')
            ->findOneBy(array('username'=>$login,'password'=>$password)) ;

        if($user!=null)
        {
            $u[]= array(
                'id'=>$user->getId(),
                'password'=>$user->getPassword(),
            );
            $data =$this->get('jms_serializer')->serialize($u,'json');
            return new JsonResponse(json_decode($data),Response::HTTP_ACCEPTED);
        }
        return new JsonResponse(false);
    }
    /**
/    *
   * @Rest\View()
     * @Rest\Post("/places")
     *
 */
    function RegistrationAction(Request $request)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers :Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $response = new Response();
        $response->headers->set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $response->headers->set("Access-Control-Allow-Methods", "GET,PUT,POST,DELETE,PATCH,OPTIONS");
        $username=$request->get('username');
        $user = new Marsupilami();
        $em=$this->getDoctrine()->getManager();
        $userr=$em->getRepository('MarsupilamiBundle:Marsupilami')->findOneBy(array('username'=>$username));
        if($userr==null) {
            $user->setUsername($username);
            $user->setPassword($request->get('password'));
            $user->setEmail($request->get('email'));
            $user->setEmailCanonical($request->get('email'));
            $user->setEnabled(1);
            $user->setSalt($request->get('password'));
            $user->setAge($request->get('age'));
            $user->setFamille($request->get('famille'));
            $user->setCouleur($request->get('couleur'));
            $user->setNourriture($request->get('nourriture'));
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
            $em->persist($user);
            try{
            $em->flush($user);
            } catch (\Exception $e) {
                print $e->getMessage();
                exit;
            }
            $response->setContent(json_encode([
                $user->getId(),
            ]));
            return $response;
        }

        $response->setContent(json_encode([
            false,
        ]));
        return $response;
    }

    /*
 * @Rest\Put("/modifapi/{id}")
 */
    function ModifAction($id,Request $request)
    {

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");
        header("Access-Control-Allow-Headers :Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $response= new JsonResponse();
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository('MarsupilamiBundle:Marsupilami')->find($id);

        if($user!=null)
        {


            if($request->get('username')!=null) {
                $user->setUsername($request->get('username'));
            }
            if($request->get('age')!=null) {
                $user->setAge($request->get('age'));
            }
            if($request->get('nourriture')!=null) {
                $user->setNourriture($request->get('nourriture'));
            }
            if($request->get('couleur')!=null) {
                $user->setCouleur($request->get('couleur'));
            }
            if($request->get('famille')!=null) {
                $user->setFamille($request->get('famille'));
            }

            $em->persist($user);
        //    try{
                $em->flush($user);

            return $response->setData(true);


        }

        return $response->setData(false);

    }
    /**
    /    *
     * @Rest\View()
     * @Rest\Post("/places")
     *
     */
    public function AddamisAction($id1,$id2){

        header("Access-Control-Allow-Origin: *");
        $response = new Response();
        $response->headers->set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $response->headers->set("Access-Control-Allow-Methods", "GET,PUT,POST,DELETE,PATCH,OPTIONS");

        $em=$this->getDoctrine()->getManager();
        $amis=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id1);
        $user=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id2);

        $user->setAmis($amis);
        $amis->setAmis($user);
        $em->persist($user);
        $em->persist($amis);
        try{
            $em->flush($user);
            $em->flush($amis);
        } catch (\Exception $e) {
            print $e->getMessage();
            exit;
        }

        $response->setContent(json_encode([
            true,
        ]));
        return $response;
    }

    /**
    /    *
     * @Rest\View()
     * @Rest\Post("/places")
     *
     */
    public function RemoveamisAction($id1,$id2){

        header("Access-Control-Allow-Origin: *");
        $response = new Response();
        $response->headers->set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $response->headers->set("Access-Control-Allow-Methods", "GET,PUT,POST,DELETE,PATCH,OPTIONS");

        $em=$this->getDoctrine()->getManager();
        $amis=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id1);
        $user=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id2);

        $user->removeAmis($amis);
        $amis->removeAmis($user);
        $em->persist($user);
        $em->persist($amis);
        try{
            $em->flush($user);
            $em->flush($amis);
        } catch (\Exception $e) {
            print $e->getMessage();
            exit;
        }

        $response->setContent(json_encode([
            true,
        ]));
        return $response;
    }







}