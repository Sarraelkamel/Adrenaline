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

use App\Repository\EquipementRepository;
use App\Entity\Equipement;
use App\Form\EquipementType;
/*
 * ezzoghlami
 */
class BackEquipementController extends AbstractController
{

    /**
     * @Route("/back/equipement", name="equipement")
     */
    public function indexCategorie(EquipementRepository $equipementRepository): Response
    {
        return $this->render('back/equipement/equipement.html.twig', [
            'equipements' => $equipementRepository->findAll()
        ]);
    }

    /**
     * @Route("/back/equipement/new", name="newEquipement")
     */
    public function newCategorie(CategorieRepository $categorieRepository): Response
    {
        return $this->render('back/equipement/newEquipement.html.twig', [
            'categorie' => $categorieRepository->findAll()
        ]);
    }


     /**
     * @Route("/back/equipement/processNew", name="equipementNew", methods={"POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipement = new Equipement();
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipement);
            $entityManager->flush();

            return $this->redirectToRoute('equipement', [], Response::HTTP_SEE_OTHER);
        }
        return $this->redirectToRoute('newEquipement', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/back/equipement/processDelete", name="equipementDelete", methods={"POST"})
     */
    public function delete(Request $request, EntityManagerInterface $entityManager,EquipementRepository $equipementRepository): Response
    {
        $id = $request->get('_id');
        $equipement = $equipementRepository->find($id);
        $entityManager->remove($equipement);
        $entityManager->flush();

        return $this->redirectToRoute('equipement', [], Response::HTTP_SEE_OTHER);
    }

    
    /**
     * @Route("/back/equipement/edit", name="editCategorie")
     */
    public function editCategorie(Request $request, EquipementRepository $equipementRepository,CategorieRepository $categorieRepository): Response
    {
        $id = $request->get('_id');
        $equipement = $equipementRepository->find($id);

        return $this->render('back/equipement/editEquipement.html.twig', [
            'equipement' => $equipement,
            'categorie' => $categorieRepository->findAll()
        ]);
    }

    
     /**
     * @Route("/back/equipement/processEdit", name="equipementEdit", methods={"POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager,EquipementRepository $equipementRepository,CategorieRepository $categorieRepository): Response
    {
        $id = $request->get('_id');
        $equipement = $equipementRepository->find($id);
        $equipement->setNomEq( $request->get('nom') );
        $equipement->setDescEq( $request->get('desc') );
        $equipement->setPrixEq( $request->get('prix') );
        $equipement->setQuantiteEq( $request->get('qnt') );
        $equipement->setImageEq( $request->get('img') );
        $equipement->setCategory( $categorieRepository->find($request->get('categorie') ));

        $entityManager->persist($equipement);
        $entityManager->flush();

        return $this->redirectToRoute('equipement', [], Response::HTTP_SEE_OTHER);

    }
}
