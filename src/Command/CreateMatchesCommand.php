<?php

namespace App\Command;

use App\Entity\Match;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateMatchesCommand extends Command
{
    protected static $defaultName = 'app:create-matches';

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('matchs players in lobby to their closest elo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $playerRepository = $this->em->getRepository("App:Player");

        $players = $playerRepository->findBy(['inLobby' => true], ['ratio' => 'ASC']);
        if(count($players) < 2){
            $io->caution('Not enough players to match');
            return Command::FAILURE;
        }

        for($i = 1; $i<count($players);$i+=2){
            $playerA = $players[$i-1];
            $playerB = $players[$i];
            $playerA->setInlobby(false);
            $playerB->setInlobby(false);
            $this->em->persist(new Match($playerA, $playerB));
            $io->success('New match between '.$playerA->getUsername().' and '.$playerB->getUsername());
        }

        $this->em->flush();

        return Command::SUCCESS;
    }
}
