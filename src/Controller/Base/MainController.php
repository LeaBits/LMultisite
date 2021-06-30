<?php

namespace App\Controller\Base;

use App\Entity\Base\BlogPost;
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

    private function createResponseParams(string $title, Object $blocks): array
    {
        $responseParameters = array();
        $responseParameters['title'] = $title;
        foreach($blocks as $block){
            try {
                $responseParameters[$block->getTemplateBlock()->getSlug()] = $block->getContent();
            }catch(\Exception $e){
                dump($e);
            }
        }
        return $responseParameters;
    }

    /**
     * @Route(
     *     name="catchAllBlogPost",
     *     host="{host}",
     *     "/blog/post/{year}/{month}/{day}/{path}",
     *     defaults={"host"="", "path"=""},
     *     requirements={"host"=".+", "path"=".+"}
     * )
     */
    public function catchAllBlogPostAction($host, $year, $month, $day, $path): Response
    {
        try {
            $site = $this->getCurrentSite($host);
            dump($site);

            $post = $this->getDoctrine()
                ->getRepository(BlogPost::class)
                ->findOneByPath($path, $site, $year, $month, $day);
            $template = $post->getTemplate();
            $blocks = $post->getBlogPostBlocks();

            return $this->render(
                $template->getUrl(), $this->createResponseParams($post->getTitle(), $blocks)
            );
        }catch(MisplacedException $e){
            dump($e);
            return $this->catch404();
        }catch(\Exception $e){
            dump($e);
            return $this->catchOtherError();
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

            /*
             * TODO: catch all by blog category
             * get category by site and path
             * get template by category
             * get blogposts by category
             * get blogpost blocks by blogpost
            */

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

            /*
             * TODO: catch all by blog tag
             * get tag by site and path
             * get template by tag
             * get blogposts by tag
             * get blogpost blocks by blogpost
             */

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

//            $responseParameters = array();
//            $responseParameters['title'] = $page->getTitle();
//            foreach($blocks as $block){
//                $responseParameters[$block->getTemplateBlock()->getSlug()] = $block->getContent();
//            }
            return $this->render(
                $template->getUrl(), $this->createResponseParams($page->getTitle(), $blocks)
            );
        }catch(MisplacedException $e){
//            dump($e);
            return $this->catch404();
        }catch(\Exception $e){
//            dump($e);
            return $this->catchOtherError();
        }
    }
}
