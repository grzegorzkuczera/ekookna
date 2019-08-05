<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BusStationRepository;
use App\Entity\BusStation;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    
    /**
     * @var BusStationRepository
     */
    private $busStationRepository;

    /**
     * @param BusStationRepository $busStationRepositor
     */
    public function __construct(BusStationRepository $busStationRepository)
    {
        $this->busStationRepository = $busStationRepository;
    }

    /**
     * @Route("/", name="admin_index")
     */
    public function index(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $busStations = $this->busStationRepository->findAll();
            return new JsonResponse([
            'data' => array_map(function ($item) {
                return [
                'id' => $item->getId(),
                'address' => $item->getAddress(),
                'description' => $item->getDescription(),
                'created_at'=> $item->getCreatedAt()->format('Y-m-d H:i:s'),
                'read' => $item->getOnRead()
            ];
            }, $busStations)]);
        } 

        return $this->render('admin/index.html.twig');
        
    }
    /**
     * @Route("/edit/{id}", name="edit_index")
     */
    public function edit(BusStation $busStation)
    {
     
        return $this->render('admin/edit.html.twig', [
            'id' => $busStation->getId(),
            'address' => $busStation->getAddress(),
            'description' => $busStation->getDescription(),
            'created_at'=> $busStation->getCreatedAt()->format('Y-m-d H:i:s'),
            'created_by'=> $busStation->getCreatedBy(),
            'read' => 1,
            'files'=> array_map(function($item) {
                return $item->getFileAsArray();
            }, $busStation->getFile()->toArray())
        ]);
    }

    /**
     * @Route("/delete")
     */
    public function delete(BusStation $busStation)
    {
       
    }
    
}
