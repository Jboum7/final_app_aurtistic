<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Form\LessonType;
use App\Repository\CategoryRepository;
use App\Repository\LessonRepository;
use App\Repository\SubjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class LessonController extends AbstractController
{
    #[Route('/lessons', name: 'app_lesson_index', methods: ['GET'])]
    #[Route(
        '/lessons/category/{categoryId}',
        name: 'app_lesson_by_category',
        requirements: ['categoryId' => '\d+'],
        methods: ['GET']
    )]
    public function index(
        LessonRepository $lessonRepository,
        CategoryRepository $categoryRepository,
        ?int $categoryId = null
    ): Response {
        $categories = $categoryRepository->findBy(
            [],
            ['title' => 'ASC']
        );

        $selectedCategory = null;

        if ($categoryId === null) {
            $lessons = $lessonRepository->findBy(
                [],
                ['title' => 'ASC']
            );
        } else {
            $selectedCategory = $categoryRepository->find($categoryId);

            if ($selectedCategory === null) {
                throw $this->createNotFoundException(
                    'This category does not exist.'
                );
            }

            $lessons = $lessonRepository->findBy(
                ['category' => $selectedCategory],
                ['title' => 'ASC']
            );
        }

        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessons,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    #[Route('/lessons/new', name: 'app_lesson_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $lesson = new Lesson();

        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lesson);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'The lesson has been created.'
            );

            return $this->redirectToRoute('app_lesson_index');
        }

        return $this->render('lesson/new.html.twig', [
            'lessonForm' => $form->createView(),
        ]);
    }

    #[Route(
        '/lessons/{id}',
        name: 'app_lesson_show',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function show(
        int $id,
        LessonRepository $lessonRepository,
        SubjectRepository $subjectRepository
    ): Response {
        $lesson = $lessonRepository->find($id);

        if ($lesson === null) {
            throw $this->createNotFoundException(
                'This lesson does not exist.'
            );
        }

        $subjects = $subjectRepository->findBy(
            ['lesson' => $lesson],
            ['position' => 'ASC']
        );

        return $this->render('lesson/show.html.twig', [
            'lesson' => $lesson,
            'subjects' => $subjects,
        ]);
    }
}
