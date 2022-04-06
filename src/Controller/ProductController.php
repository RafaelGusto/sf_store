<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/products", name="products_")
 */

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }

    /**
     * @Route("/", name="index", methods={"POST"})
     */
    public function create(Request $request)
    {
        $productData = $request->request->all();

        $product = new Product();
        $product->setName($productData['name']);
        $product->setDescription($productData['description']);
        $product->setContent($productData['content']);
        $product->setPrice($productData['price']);
        $product->setSlug($productData['slug']);
        $product->setIsActive(true);
        $product->setCreatedAt(new \DateTime("now", new \DateTimeZone('America/Sao_Paulo')));
        $product->setUpdatedAt(new \DateTime("now", new \DateTimeZone('America/Sao_Paulo')));

        $doctrine = $this->getDoctrine()->getManager(); /** usa o doctrine, e o comando getManager nos permite modificar */

        $doctrine->persist($product);
        $doctrine->flush();

        return $this->json([
            'message'=> 'Produto criado com sucesso!'
        ]);
    }
}
