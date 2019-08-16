<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\UserPreferences;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class RegisterController extends AbstractController
{
     /**
     * @Route("/register", name="user_register")
     */
    public function register(
        UserPasswordEncoderInterface $passwordEncoder,
        Request $request
    ) {
        $user = new User();
        $form = $this->createForm(
            UserType::class,
            $user
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword()
            );
            $user->setPassword($password);

            $locale = $this->getParameter('locale');
            $preferences = new UserPreferences();
            $preferences->setLocale($locale);

            $user->setPreferences($preferences);
            $entityManager = $this->getDoctrine()
                ->getManager();
        
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('default_index');
        }

        return $this->render(
            'register/register.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
