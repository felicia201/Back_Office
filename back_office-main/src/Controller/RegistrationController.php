<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\SecuriteAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, SecuriteAuthenticator $authenticator, EntityManagerInterface $entityManager, MailerInterface $mailer, TranslatorInterface $translator): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute(route:'app_auth_page');
         }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Persist the user entity
            $entityManager->persist($user);
            $entityManager->flush();

            // Send confirmation email
            $this->sendConfirmationEmail($user, $mailer, $translator);

            // Redirect the user after registration
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        // Render the registration form view
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * Send confirmation email to the user.
     */
    private function sendConfirmationEmail(User $user, MailerInterface $mailer, TranslatorInterface $translator): void
    {
        $email = (new Email())
            ->from('your_email@example.com')
            ->to($user->getEmail())
            ->subject($translator->trans('registration.email.subject'))
            ->html($this->renderView('email/registration_confirmation.html.twig', [
                'user' => $user,
            ]));

        $mailer->send($email);
    }
}
