<?php

namespace App\Controller;

use App\Entity\Setting;
use App\Form\SettingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app_settings', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
        $setting = $user->getSetting();

        $form = $this->createForm(SettingType::class, $setting);
        $form->handleRequest($request);

        if ($setting === null) {
            $setting = new Setting();
            $setting->setFontsize(1);
            $setting->setFontweight(400);
            $setting->setFontstretch(100);
            $setting->setTheme('light');
            $setting->setUser($user);
        }

        if ($setting->getTheme() === null) {
            $setting->setTheme('light');
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($setting);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your settings have been updated.'
            );

            return $this->redirectToRoute('app_settings');
        }

        return $this->render('settings/index.html.twig', [
            'settingForm' => $form->createView(),
        ]);
    }
}
