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

    /**
     * @var int interval to add as seconds
     */
    protected $secondsToAdd = 3600;

    protected $doc;

    protected function configure()
    {
        $this->setName('app:search')
            ->setDescription('Command run by Cron');

        //$this->doc = $this->getContainer()->get('doctrine');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        $this->doc = $this->getContainer()->get('doctrine');

        var_dump($this->chooseFilterToSearch());

        $output->writeln('Done');

        $this->release();
    }

    protected function chooseFilterToSearch()
    {
        $filter = null;

        $flatRepo = $this->doc->getRepository(FlatFilter::class);
        $flatFilters = $flatRepo->findOrderedByDateLastSearchWithLimit($this->resultsLimit);
        $flatFiltersAllCount = intval($flatRepo->getFlatFilterCount()[0][1]);
        $flatFilterDateLastSearch = null;
        if ($flatFiltersAllCount > 0) $flatFilterDateLastSearch = $flatFilters[0]->getDateLastSearch();


        $houseRepo = $this->doc->getRepository(HouseFilter::class);
        $houseFilters = $houseRepo->findOrderedByDateLastSearchWithLimit($this->resultsLimit);
        $houseFiltersAllCount = intval($houseRepo->getHouseFilterCount()[0][1]);
        $houseFilterDateLastSearch = null;
        if ($houseFiltersAllCount > 0) $houseFilterDateLastSearch = $houseFilters[0]->getDateLastSearch();


        $groundRepo = $this->doc->getRepository(GroundFilter::class);
        $groundFilters = $groundRepo->findOrderedByDateLastSearchWithLimit($this->resultsLimit);
        $groundFiltersAllCount = intval($groundRepo->getGroundFilterCount()[0][1]);
        $groundFilterDateLastSearch = null;
        if ($groundFiltersAllCount > 0) $groundFilterDateLastSearch = $groundFilters[0]->getDateLastSearch();



        $choiceByCount = null;
        if ($flatFiltersAllCount > $houseFiltersAllCount) {
            if ($flatFiltersAllCount > $groundFiltersAllCount) {
                $choiceByCount = 'flat';
            }
            elseif ($flatFiltersAllCount < $groundFiltersAllCount) {
                $choiceByCount = 'ground';
            }
        }
        elseif ($flatFiltersAllCount < $houseFiltersAllCount) {
            if ($houseFiltersAllCount > $groundFiltersAllCount) {
                $choiceByCount = 'house';
            }
            elseif ($houseFiltersAllCount < $groundFiltersAllCount) {
                $choiceByCount = 'ground';
            }
        }
        // else $choiceByCount = null;


        $choiceByDateLastSearch = null;
        $currentDate = new \DateTime();
        if ($choiceByCount == 'flat') {
            if ($flatFilterDateLastSearch->add(new \DateInterval('PT'.$this->secondsToAdd)) < $currentDate) {
                $choiceByDateLastSearch = 'flat';
            }

        }
        elseif ($choiceByCount == 'house') {

        }
        elseif ( $choiceByCount == 'ground') {

        }
        else {

        }


        $filter = null;

        return $filter;
    }

}