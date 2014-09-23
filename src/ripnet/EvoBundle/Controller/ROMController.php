<?php

namespace ripnet\EvoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ROMController
 * @package ripnet\EvoBundle\Controller
 * @Route("/rom")
 */
class ROMController extends Controller
{
    /**
     * @Route("/", name="rom")
     * @Template()
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('ripnetEvoBundle:ROM');

        $roms = $repository->findAll();
        return array(
            'roms'      => $roms,
        );
    }

    /**
     * @Route("/tree", name="rom_tree")
     * @Template()
     */
    public function treeAction()
    {
        $repository = $this->getDoctrine()->getRepository('ripnetEvoBundle:ROM');
        //$parents = $repository->findBy(array('parent' => null));
        $parents = $repository->getParents();

        return array(
                'parents'  => $parents,
            );
    }

    /**
     * @Route("/scalings", name="rom_scalings")
     * @Template()
     */
    public function scalingsAction()
    {
        $repository = $this->getDoctrine()->getRepository('ripnetEvoBundle:Scaling');
        $scalings = $repository->findAll();

        return array(
            'scalings'  => $scalings,
        );
    }

    /**
     * @Route("/tables", name="rom_tables")
     * @Template()
     */
    public function tablesAction()
    {
        //$repository = $this->getDoctrine()->getRepository('ripnetEvoBundle:Table');
        //$tables = $repository->findAll();
        $tables = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT t, c, s FROM ripnetEvoBundle:Table t JOIN t.category c JOIN t.scaling s ORDER BY c.weight')
            ->getResult();
        return array(
            'tables'  => $tables,
        );
    }

    /**
     * @Route("/generate/{romid}", name="rom_generate")
     * @Template()
     */
    public function generateAction($romid)
    {
        $repository = $this->getDoctrine()->getRepository('ripnetEvoBundle:ROM');
        $rom = $repository->findOneBy(array('xmlid' => $romid));

        //$repository = $this->getDoctrine()->getRepository('ripnetEvoBundle:ROMTable');
        //$tables = $repository->findBy(array('rom' => $rom));
        $tables = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT rt, r, t, c, s FROM ripnetEvoBundle:ROMTable rt JOIN rt.rom r JOIN rt.table t JOIN t.category c JOIN t.scaling s WHERE r.id = ' . $rom->getId() . ' ORDER BY c.weight')
            ->getResult();

        /*$r = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT r, c FROM ripnetEvoBundle:ROM r JOIN r.children c')
            ->getResult();
        */
        return array(
            'rom'       => $rom,
            'tables'    => $tables,
        );
    }
}
