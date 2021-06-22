<?php

namespace App\Controller\Base;

use App\Entity\Base\Page;
use App\Entity\Base\Site;
use App\Exception\Base\MisplacedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @param $host
     * @return Site
     * @throws MisplacedException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getCurrentSite($host): Site
    {
        return $this->getDoctrine()
            ->getRepository(Site::class)
            ->findOneByHostname($host);
    }

    /**
     * @return Response
     */
    private function catch404(){
        return $this->render('404.html.twig', []);
    }

    /**
     * @return Response
     */
    private function catchOtherError(){
        return $this->render('error.html.twig', []);
    }

    /**
     * @Route(
     *     name="catchAllBlogPost",
     *     host="{host}",
     *     "/blog/post/{path}",
     *     defaults={"host"="", "path"=""},
     *     requirements={"host"=".+", "path"=".+"}
     * )
     */
    public function catchAllBlogPostAction($host, $path): Response
    {
        try {
            $site = $this->getCurrentSite($host);
            dump($site);

            // blog
            //TODO: get blogposts by path
            //TODO: get blogpost blocks by blogpost

//            return $this->render('base/main/index.html.twig', [
//                'controller_name' => 'MainController',
//            ]);
        }catch(\Exception $e){
            dump($e->getMessage());
            return $this->catch404();
        }
    }

    /**
     * @Route(
     *     name="catchAllBlogCategory",
     *     host="{host}",
     *     "/blog/category/{path}",
     *     defaults={"host"="", "path"=""},
     *     requirements={"host"=".+", "path"=".+"}
     * )
     */
    public function catchAllBlogCategoryAction($host, $path): Response
    {
        try {
            $site = $this->getCurrentSite($host);
            dump($site);

            // blog
            //TODO: get category by site and path
            //TODO: get template by category
            //TODO: get blogposts by category
            //TODO: get blogpost blocks by blogpost

//            return $this->render('base/main/index.html.twig', [
//                'controller_name' => 'MainController',
//            ]);
        }catch(\Exception $e){
            dump($e->getMessage());
            return $this->catch404();
        }
    }

    /**
     * @Route(
     *     name="catchAllBlogTag",
     *     host="{host}",
     *     "/blog/tag/{path}",
     *     defaults={"host"="", "path"=""},
     *     requirements={"host"=".+", "path"=".+"}
     * )
     */
    public function catchAllBlogTagAction($host, $path): Response
    {
        try {
            $site = $this->getCurrentSite($host);
            dump($site);

            // blog
            //TODO: get tag by site and path
            //TODO: get template by tag
            //TODO: get blogposts by tag
            //TODO: get blogpost blocks by blogpost

//            return $this->render('base/main/index.html.twig', [
//                'controller_name' => 'MainController',
//            ]);
        }catch(\Exception $e){
            dump($e->getMessage());
            return $this->catch404();
        }
    }

    /**
     * @Route(
     *     name="catchAll",
     *     host="{host}",
     *     "/{path}",
     *     defaults={"host"="", "path"=""},
     *     requirements={"host"=".+", "path"=".+"}
     * )
     */
    public function catchAllAction($host, $path): Response
    {
        try {
            $site = $this->getCurrentSite($host);

            // pages
            $page = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findOneByPath($path, $site);
            $template = $page->getTemplate();
            $blocks = $page->getPageBlocks();

            $responseParameters = array();
            $responseParameters['title'] = $page->getTitle();
            foreach($blocks as $block){
                $responseParameters[$block->getTemplateBlock()->getSlug()] = $block->getContent();
            }
            return $this->render($template->getUrl(), $responseParameters);
        }catch(MisplacedException $e){
//            dump($e);
            return $this->catch404();
        }catch(\Exception $e){
//            dump($e);
            return $this->catchOtherError();
        }
    }
}
