<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    public function changePassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $data = json_decode($request->getContent(), true);
        
        // get the user from the JWT token
        $user = $this->getUser();
        
        // check that the current password is correct
        if (!$encoder->isPasswordValid($user, $data['current_password'])) {
            throw new AccessDeniedHttpException();
        }
        
        // hash the new password and set it on the user
        $hashedPassword = $encoder->encodePassword($user, $data['new_password']);
        $user->setPassword($hashedPassword);
        
        // save the user to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        // return a 200 OK status code
        return new Response(null, Response::HTTP_OK);
    }
}
