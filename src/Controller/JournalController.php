<?php

namespace App\Controller;

use App\Entity\Journal;
use App\Form\JournalType;
use App\Repository\JournalRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class JournalController extends AbstractController
{
    #[Route('/journal', name: 'app_journal', methods: ['GET'])]
    public function index(JournalRepository $journalRepository): Response
    {
        $journals = $journalRepository->findBy(
            ['user' => $this->getUser()],
            ['createdAt' => 'DESC']
        );

        return $this->render('journal/index.html.twig', [
            'journals' => $journals,
        ]);
    }

    #[Route('/journal/new', name: 'app_journal_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $journal = new Journal();

        $form = $this->createForm(JournalType::class, $journal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTime();

            $journal->setCreatedAt($now);
            $journal->setUpdatedAt($now);
            $journal->setUser($this->getUser());

            $entityManager->persist($journal);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your journal has been created.'
            );

            return $this->redirectToRoute('app_journal');
        }

        return $this->render('journal/new.html.twig', [
            'journalForm' => $form->createView(),
        ]);
    }

    #[Route(
        '/journal/{id}',
        name: 'app_journal_show',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function show(
        int               $id,
        JournalRepository $journalRepository,
        NoteRepository    $noteRepository
    ): Response
    {
        $journal = $journalRepository->find($id);

        if ($journal === null) {
            throw $this->createNotFoundException(
                'This journal does not exist.'
            );
        }

        if ($journal->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException(
                'You cannot access this journal.'
            );
        }

        $notes = $noteRepository->findBy(
            ['journal' => $journal],
            ['createdAt' => 'DESC']
        );

        return $this->render('journal/show.html.twig', [
            'journal' => $journal,
            'notes' => $notes,
        ]);
    }
}
