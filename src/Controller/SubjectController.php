<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\LessonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class SubjectController extends AbstractController
{
    #[Route(
        '/lessons/{lessonId}/subjects/new',
        name: 'app_subject_new',
        requirements: ['lessonId' => '\d+'],
        methods: ['GET', 'POST']
    )]
    public function new(
        int $lessonId,
        LessonRepository $lessonRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $lesson = $lessonRepository->find($lessonId);

        if ($lesson === null) {
            throw $this->createNotFoundException(
                'This lesson does not exist.'
            );
        }

        $subject = new Subject();

        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTime();

            $subject->setCreatedAt($now);
            $subject->setUpdatedAt($now);
            $subject->setLesson($lesson);

            $entityManager->persist($subject);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'The lesson content has been added.'
            );

            return $this->redirectToRoute('app_lesson_show', [
                'id' => $lesson->getId(),
            ]);
        }

        return $this->render('subject/new.html.twig', [
            'subjectForm' => $form->createView(),
            'lesson' => $lesson,
        ]);
    }
}
