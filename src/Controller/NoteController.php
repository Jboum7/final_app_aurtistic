<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\JournalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class NoteController extends AbstractController
{
    #[Route(
        '/journal/{journalId}/note/new',
        name: 'app_note_new',
        requirements: ['journalId' => '\d+'],
        methods: ['GET', 'POST']
    )]
    public function new(
        int $journalId,
        JournalRepository $journalRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $journal = $journalRepository->find($journalId);

        if ($journal === null) {
            throw $this->createNotFoundException(
                'This journal does not exist.'
            );
        }

        if ($journal->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException(
                'You cannot add a note to this journal.'
            );
        }

        $note = new Note();

        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTime();

            $note->setCreatedAt($now);
            $note->setUpdatedAt($now);
            $note->setJournal($journal);

            $entityManager->persist($note);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your note has been added.'
            );

            return $this->redirectToRoute('app_journal_show', [
                'id' => $journal->getId(),
            ]);
        }

        return $this->render('note/new.html.twig', [
            'noteForm' => $form->createView(),
            'journal' => $journal,
        ]);
    }
}
