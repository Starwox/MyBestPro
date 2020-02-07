<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 07/02/2020
 * Time: 16:26
 */

namespace App\Command;


use App\Entity\Status;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatusCommand extends Command
{

    /**
     * StatusCommand constructor.
     * @var EntityManagerInterface $em
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('app:status')
            ->setDescription("Cette commande permet de remplir la table Status")
            ->addOption('force', 'f')
            ->setHelp('This command allow you to create statement. Use --force to force add');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $exist = $this->em->getRepository(Status::class)->findAll();


        $count = count($exist);

        if ($count > 2)
            $exist = false;
        else
            $exist = true;

        if ($exist OR $input->getOption('force'))
        {
            $status = new Status();
            $status->setName('A faire');
            $this->em->persist($status);
            $status = new Status();
            $status->setName('En cours');
            $this->em->persist($status);
            $status = new Status();
            $status->setName('Terminée');
            $this->em->persist($status);

            $this->em->flush();
            echo "L'ajout en base de données a été effectué !\n";

        }
        else
            echo "Déjà en table / Utilisez --force (ou -f) pour forcer l'ajout\n";

        return 1;
    }

}