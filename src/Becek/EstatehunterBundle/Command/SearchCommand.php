<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 21.06.2018
 * Time: 00:20
 */

namespace Becek\EstatehunterBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Becek\EstatehunterBundle\Entity\Filters\FlatFilter;
use Becek\EstatehunterBundle\Entity\Filters\GroundFilter;
use Becek\EstatehunterBundle\Entity\Filters\HouseFilter;

class SearchCommand extends ContainerAwareCommand
{
    use LockableTrait;

    protected $resultsLimit = 50;
    protected $doc;

    protected function configure()
    {
        $this->setName('app:search')
            ->setDescription('Command run by Cron');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        $this->doc = $this->getContainer()->get('doctrine');



        $output->writeln('Jo');

        $this->release();
    }

    protected function chooseFilterToSearch()
    {
        $flatFilters = $this->doc->getRepository(FlatFilter::class)->findOrderedByDateLastSearchWithLimit($this->resultsLimit);
        $houseFilters = $this->doc->getRepository(HouseFilter::class)->findOrderedByDateLastSearchWithLimit($this->resultsLimit);
        $groundFilters = $this->doc->getRepository(GroundFilter::class)->findOrderedByDateLastSearchWithLimit($this->resultsLimit);

    }

}