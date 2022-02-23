<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;
use App\Form\CategorieType;

/*
 * ezzoghlami
 */
class BackController extends AbstractController
{
    /**
     * @Route("/back", name="back")
     */
    public function index(): Response
    {
        return $this->render('back/index.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }


    /**
     * @Route("/back/categorie", name="categorie")
     */
    public function indexCategorie(CategorieRepository $categorieRepository): Response
    {
        return $this->render('back/categorie.html.twig', [
            'categories' => $categorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/back/categorie/new", name="newCategorie")
     */
    public function newCategorie(CategorieRepository $categorieRepository): Response
    {
        return $this->render('back/newCategorie.html.twig', [
            'categories' => $categorieRepository->findAll()
        ]);
    }


     /**
     * @Route("/back/categorie/processNew", name="categorieNew", methods={"POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie', [], Response::HTTP_SEE_OTHER);
        }
        return $this->redirectToRoute('newCategorie', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/back/categorie/processDelete", name="categorieDelete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager,CategorieRepository $categorieRepository): Response
    {
        $id = $request->get('_id');
        $categorie = $categorieRepository->find($id);
        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->redirectToRoute('categorie', [], Response::HTTP_SEE_OTHER);
    }

    
    /**
     * @Route("/back/categorie/edit", name="editCategorie")
     */
    public function editCategorie(Request $request, CategorieRepository $categorieRepository): Response
    {
        $id = $request->get('_id');
        $categorie = $categorieRepository->find($id);

        return $this->render('back/editCategorie.html.twig', [
            'categorie' => $categorie
        ]);
    }

    
     /**
     * @Route("/back/categorie/processEdit", name="categorieEdit", methods={"POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager,CategorieRepository $categorieRepository): Response
    {
        $id = $request->get('_id');
        $categorie = $categorieRepository->find($id);
        $categorie->setNomCa( $request->get('nom') );

        $entityManager->persist($categorie);
        $entityManager->flush();

        return $this->redirectToRoute('categorie', [], Response::HTTP_SEE_OTHER);

    }
}
