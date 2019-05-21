<?php

namespace ActivityBundle\Controller;

use ActivityBundle\Entity\Activity;
use ActivityBundle\Entity\Deslikes;
use ActivityBundle\Entity\Likes;
use ActivityBundle\Entity\Rating;
use ActivityBundle\Form\ActivityType;
use ActivityBundle\Form\RatingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActivityController extends Controller
{
    public function addAction(Request $request){
        // preparer un form
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form = $form->handleRequest($request);

        if ($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $activity->setDatecreation(new \DateTime());
            $activity->setNbvue(0);
            $activity->setIduser($this->getUser());
            $em->persist($activity);
            $em->flush();
            $id=$activity->getId();
            //return $this->render('@Activity/activity/rating.html.twig', array('id'=>$id));
            return $this->redirectToRoute('activity_activity_addrating',array('id'=>$id));
        }
        return $this->render('@Activity/activity/activityadd.html.twig', array('form'=>$form->createView()));

    }
    public function displayAction(){
        $activities=$this->getDoctrine()->getRepository(Activity::class)->findAll();
        return $this->render('@Activity/activity/activitydisplay.html.twig', array('list'=>$activities));

    }
    public function singleAction(Request $id){
        $id=$id->get('id');

        $activity=$this->getDoctrine()->getRepository(Activity::class)->find($id);
        if (!$activity) {
            return $this->redirectToRoute('activity_activity_display');
        }
        else {
            $n=$activity->getNbvue();
            $n=$n+1;
            $activity->setNbvue($n);
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $idact=$activity->getId();
            $checklikes=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idact);
            $checkdes=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idact);
            if ( $checklikes ) {
                $likescheck = true;
            }
            else {
                $likescheck = false;
            }
            if ($checkdes) {
                $descheck = true;

            }else{

                $descheck = false;
            }

            return $this->render('@Activity/activity/single.html.twig', array('activity'=>($activity),
                'likes'=>($likescheck),
                'deslikes'=>($descheck)));
        }


    }

    public function likesAction(Request $request) {
        $idAct = $request->get('idact');
        $activity=$this->getDoctrine()->getRepository(Activity::class)->find($idAct);
        $iduser = $this->getUser();
        $id = $this->getUser()->getId();
        $check=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idAct);
        if (!$check){
            $likes = new Likes();
            $likes->setIdAct($activity);
            $likes->setInUser($iduser);
            $em=$this->getDoctrine()->getManager();
            $em->persist($likes);
            $em->flush();
            $checkdes=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idAct);
            if ($checkdes){
                $em=$this->getDoctrine()->getManager();
                foreach ($checkdes as $item) {
                    $deslikesrem = $item;
                    $em->remove($deslikesrem);
                    $em->flush();
                }

            }

            $checklikes=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idAct);
            $checkdes=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idAct);
            if ( $checklikes ) {
                $likescheck = true;
            }
            else {
                $likescheck = false;
            }
            if ($checkdes) {
                $descheck = true;

            }else{

                $descheck = false;
            }
            return $this->render('@Activity/activity/single.html.twig', array('activity'=>($activity),
                'likes'=>($likescheck),
                'deslikes'=>($descheck)));
        }
        else {
            $em=$this->getDoctrine()->getManager();
            foreach ($check as $item) {
                $likesrem = $item;
                $em->remove($likesrem);
            }

            $em->flush();
            $checklikes=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idAct);
            $checkdes=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idAct);
            if ( $checklikes ) {
                $likescheck = true;
            }
            else {
                $likescheck = false;
            }
            if ($checkdes) {
                $descheck = true;

            }else{

                $descheck = false;
            }
            return $this->render('@Activity/activity/single.html.twig', array('activity'=>($activity),
                'likes'=>($likescheck),
                'deslikes'=>($descheck)));
        }

    }
    public function deslikesAction(Request $request) {
        $idAct = $request->get('idact');
        $activity=$this->getDoctrine()->getRepository(Activity::class)->find($idAct);
        $iduser = $this->getUser();
        $id = $this->getUser()->getId();
        $check=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idAct);
        if (!$check){
            $likes = new Deslikes();
            $likes->setIdAct($activity);
            $likes->setIdUser($iduser);
            $em=$this->getDoctrine()->getManager();
            $em->persist($likes);
            $em->flush();
            $checkdes=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idAct);
            if ($checkdes){
                $em=$this->getDoctrine()->getManager();
                foreach ($checkdes as $item) {
                    $likesrem = $item;
                    $em->remove($likesrem);
                    $em->flush();
                }

            }

            $checklikes=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idAct);
            $checkdes=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idAct);
            if ( $checklikes ) {
                $likescheck = true;
            }
            else {
                $likescheck = false;
            }
            if ($checkdes) {
                $descheck = true;

            }else{

                $descheck = false;
            }
            return $this->render('@Activity/activity/single.html.twig', array('activity'=>($activity),
                'likes'=>($likescheck),
                'deslikes'=>($descheck)));
        }
        else {
            $em=$this->getDoctrine()->getManager();
            foreach ($check as $item) {
                $likesrem = $item;
                $em->remove($likesrem);
            }
            $em->flush();
            $checklikes=$this->getDoctrine()->getRepository(Likes::class)->Findlikes($id, $idAct);
            $checkdes=$this->getDoctrine()->getRepository(Deslikes::class)->Finddeslike($id, $idAct);
            if ( $checklikes ) {
                $likescheck = true;
            }
            else {
                $likescheck = false;
            }
            if ($checkdes) {
                $descheck = true;

            }else{

                $descheck = false;
            }
            return $this->render('@Activity/activity/single.html.twig', array('activity'=>($activity),
                'likes'=>($likescheck),
                'deslikes'=>($descheck)));
        }



    }

    public function removeAction(Request $request){
        //creation d'un objet
        $id=$request->get('id');
        $activity=$this->getDoctrine()->getRepository(Activity::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($activity);
        $em->flush();
        return $this->redirectToRoute('activity_activity_display');

    }
    public function addratingAction(Request $request){
        // preparer un form
        $id=$request->get('id');
        $actrating=$this->getDoctrine()->getRepository(Activity::class)->find($id);
        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);
        $form = $form->handleRequest($request);

        if ($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $rating->setIdact($actrating);
            $rating->setIduser($this->getUser());
            $em->persist($rating);
            $em->flush();
        }
        return $this->render('@Activity/activity/rating.html.twig', array('form'=>$form->createView()));

    }


}
