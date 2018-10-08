<?php

namespace MarsupilamiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use http\Env\Response;
use MarsupilamiBundle\Form\MarsupilamiType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;




class DefaultController extends Controller
{
    /**
     * @Route("/api/programme)
     * @Method("POST")
     */
    public function newAction(Request $request){
        return new JsonResponse(false);
    }
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $utilisateur=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($user);
        return $this->render('MarsupilamiBundle:Default:index.html.twig',array("marsupilami"=>$utilisateur));
    }

    public function  ModifierAction($id, Request $request) {

        $em=$this->getDoctrine()->getManager() ;
        $marsupilami=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id);
        $Form=$this->createForm(MarsupilamiType::class, $marsupilami) ;
        $Form->handleRequest($request);
        if($Form->isValid()) {
            $em->persist($marsupilami) ;
            $em->flush() ;
            return $this->redirectToRoute('marsupilami_homepage') ; //thezni lel affiche
        }
        return $this->render('MarsupilamiBundle:Default:modifier.html.twig',
            array('form'=>$Form->createView())) ;
    }

    public function AmisAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $all=$em->getRepository("MarsupilamiBundle:Marsupilami")->findAll();
        $amis=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($user->getId());
        $user->setAmis($amis);
        return $this->render("MarsupilamiBundle:Default:amis.html.twig", array("amis"=>$all)) ;
    }

    public function AddamisAction($id,Request $request){
        $em=$this->getDoctrine()->getManager();
        $amis=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($id);
        $user=$this->getUser();

        $user->setAmis($amis);
        $amis->setAmis($user);
        $em=$this->getDoctrine()->getManager() ;
        $em->persist($user);
        $em->flush() ;
        return $this->redirectToRoute("marsupilami_amis");
        //return $this->render("MarsupilamiBundle:Default:amis.html.twig", array("amis"=>$all)) ;
    }

    public function SuppAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $amis= $em->getRepository('MarsupilamiBundle:Marsupilami')->findOneBy(array('id'=>$id)) ;
        $all=$em->getRepository("MarsupilamiBundle:Marsupilami")->findAll();
        $user=$this->getUser();
        $user->removeAmis($amis);
        $amis->removeAmis($user);
        $em->flush();
        return $this->redirectToRoute("marsupilami_amis");
        //return $this->render("MarsupilamiBundle:Default:amis.html.twig", array("amis"=>$all)) ;
    }


    /**
     * @Route("/api/post/{login}/{password}",name="login_Rest")
     * @Method({"GET"})
     */
    function loginRestAction(Request $req,$login,$password){

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


                //password entered is OK
        }

        return new JsonResponse(false);

    }

    public function getAction()
    {
        $u[]= array(
            'id'=>"ea",
            'password'=>"ee",
        );
        $data =$this->get('jms_serializer')->serialize($u,'json');
        return new JsonResponse(json_decode($data),Response::HTTP_ACCEPTED);
    }


    function RegistrationAction(Request $req, $login, $nom, $prenom, $password, $email, $telephone,$avatar)
    {
        $userManager = $this->userManager->createUser();
        $bool=true;
        $userr=null;

        $em=$this->getDoctrine()->getManager();
        $userr=$em->getRepository('MarsupilamiBundle:Marsupilami')->findOneBy(array('username'=>$login));

        if($userr!=null)
        {
            $response= new JsonResponse();
            $bool=false;
            return  $response->setData($bool);
        }

        $user =$userManager->createUser();
        $user->setUsername($login);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setTelephone($telephone);
        $user->setSolde(0);
        $user->setAvatar($avatar);
        $user->setUsernameCanonical($login);
        $user->setEmailCanonical($email);
        $user->setEnabled(0);
        $user->setSalt(null);
        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        $user->setConfirmationToken($tokenGenerator->generateToken());
        $user->setPasswordRequestedAt(null);
        $user->setLastActivityAt(null);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRole("client");
        $user->addRole('ROLE_USER');
        $user->addRole('client');
        $userManager->updateUser($user);
        $em->persist($user);
        $em->flush($user);

        $response= new JsonResponse();
        $bool=true;
        return  $response->setData($bool);
    }



}
