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

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        $this->doc = $this->getContainer()->get('doctrine');

        $filter = $this->chooseFilterToSearch();
        if ($filter !== null) {
            $filterType = '';
            if ($filter instanceof FlatFilter) {
                $filterType = 'flat';
            }
            elseif ($filter instanceof HouseFilter) {
                $filterType = 'house';
            }
            elseif ($filter instanceof GroundFilter) {
                $filterType = 'ground';
            }

            $gratkaOptions = $this->getGratkaOptionsFromFilter($filter, $filterType);
            $olxOptions = $this->getOlxOptionsFromFilter($filter, $filterType);
            $otodomOptions = $this->getOtodomOptionsFromFilter($filter, $filterType);

            echo 'GRATKA' . PHP_EOL;
            var_dump($gratkaOptions);

            echo 'OTODOM' . PHP_EOL;
            var_dump($otodomOptions);

            echo 'OLX' . PHP_EOL;
            var_dump($olxOptions);

            exit;

            $domGratkaGenerator = new DomGratkaScraper();
            $gratkaOffers = $domGratkaGenerator->loadOffersFromPages($gratkaOptions);

            $olxGenerator = new OlxScraper();
            $olxOffers = $olxGenerator->loadOffersFromPages($olxOptions);

            $otodomGenerator = new OtodomScraper();
            $otodomOffers = $otodomGenerator->loadOffersFromPages($otodomOptions);


        }


        $output->writeln('Done');

        $this->release();
    }


    protected function getGratkaOptionsFromFilter($filter, $filterType)
    {
        $options = array();
        // mieszkania/domy/dzialki-grunty
        switch ($filterType) {
            case 'flat':
                $options['category'] = 'mieszkania';
                $options['areaFrom'] = $filter->getAreaFrom();
                $options['areaTo'] = $filter->getAreaTo();

                /*
                $options['constructionYearFrom'] = $filter->getConstructionYearFrom();
                $options['constructionYearTo'] = $filter->getConstructionYearTo();

                $options['floorsCountFrom'] = $filter->getFloorsCountFrom();
                $options['floorsCountTo'] = $filter->getFloorsCountTo();

                $options['roomsCount'] = $filter->getRoomsCount();

                $options['buildingType'] = $filter->getBuildingType();
                */
                break;

            case 'house':
                $options['category'] = 'domy';
                $options['areaFrom'] = $filter->getAreaFrom();
                $options['areaTo'] = $filter->getAreaTo();
                $options['groundAreaFrom'] = $filter->getGroundAreaFrom();
                $options['groundAreaTo'] = $filter->getGroundAreaTo();

                /*
                $options['constructionYearFrom'] = $filter->getConstructionYearFrom();
                $options['constructionYearTo'] = $filter->getConstructionYearTo();

                $options['floorsCountFrom'] = $filter->getFloorsCountFrom();
                $options['floorsCountTo'] = $filter->getFloorsCountTo();

                $options['roomsCountFrom'] = $filter->getRoomsCountFrom();
                $options['roomsCountTo'] = $filter->getRoomsCountTo();

                $options['buildingType'] = $filter->getBuildingType();
                */
                break;

            case 'ground':
                $options['category'] = 'dzialki-grunty';
                $options['groundAreaFrom'] = $filter->getGroundAreaFrom();
                $options['groundAreaTo'] = $filter->getGroundAreaTo();
                break;
        }

        // sprzedaz/wynajem
        switch ($filter->getOfferType()) {
            case 0:
                $options['offerType'] = 'sprzedaz';
                break;
            case 1:
                $options['offerType'] = 'wynajem';
                break;
        }


        $options['priceFrom'] = $filter->getPriceFrom();
        $options['priceTo'] = $filter->getPriceTo();

        $options['priceAreaFrom'] = $filter->getPriceAreaFrom();
        $options['priceAreaTo'] = $filter->getPriceAreaTo();

        $options['localization']['subregion'] = $filter->getSubRegion();
        $options['localization']['region'] = $filter->getRegion();
        $options['localization']['town'] = $filter->getCity();

        $options['addedBy'] = $filter->getAddedBy();

        return $options;
    }

    protected function getOlxOptionsFromFilter($filter, $filterType)
    {
        $options = array();
        // mieszkania/domy
        switch ($filterType) {
            case 'flat':
                $options['category'] = 'mieszkania';
                $options['areaFrom'] = $filter->getAreaFrom();
                $options['areaTo'] = $filter->getAreaTo();

                /*
                $options['constructionYearFrom'] = $filter->getConstructionYearFrom();
                $options['constructionYearTo'] = $filter->getConstructionYearTo();

                $options['floorsCountFrom'] = $filter->getFloorsCountFrom();
                $options['floorsCountTo'] = $filter->getFloorsCountTo();

                $options['roomsCount'] = $filter->getRoomsCount();

                $options['buildingType'] = $filter->getBuildingType();
                */
                break;

            case 'house':
                $options['category'] = 'domy';
                $options['areaFrom'] = $filter->getAreaFrom();
                $options['areaTo'] = $filter->getAreaTo();

                /*
                $options['constructionYearFrom'] = $filter->getConstructionYearFrom();
                $options['constructionYearTo'] = $filter->getConstructionYearTo();

                $options['floorsCountFrom'] = $filter->getFloorsCountFrom();
                $options['floorsCountTo'] = $filter->getFloorsCountTo();

                $options['roomsCountFrom'] = $filter->getRoomsCountFrom();
                $options['roomsCountTo'] = $filter->getRoomsCountTo();

                $options['buildingType'] = $filter->getBuildingType();
                */
                break;
        }

        // sprzedaz/wynajem
        switch ($filter->getOfferType()) {
            case 0:
                $options['offerType'] = 'sprzedaz';
                break;
            case 1:
                $options['offerType'] = 'wynajem';
                break;
        }

        $options['priceFrom'] = $filter->getPriceFrom();
        $options['priceTo'] = $filter->getPriceTo();

        $options['priceAreaFrom'] = $filter->getPriceAreaFrom();
        $options['priceAreaTo'] = $filter->getPriceAreaTo();

        $options['localization']['subregion'] = $filter->getSubRegion();
        $options['localization']['region'] = $filter->getRegion();
        $options['localization']['town'] = $filter->getCity();

        $options['addedBy'] = $filter->getAddedBy();

        return $options;
    }

    protected function getOtodomOptionsFromFilter($filter, $filterType)
    {
        $options = array();
        // mieszkanie/domy
        switch ($filterType) {
            case 'flat':
                $options['category'] = 'mieszkania';
                $options['areaFrom'] = $filter->getAreaFrom();
                $options['areaTo'] = $filter->getAreaTo();

                /*
                $options['constructionYearFrom'] = $filter->getConstructionYearFrom();
                $options['constructionYearTo'] = $filter->getConstructionYearTo();

                $options['floorsCountFrom'] = $filter->getFloorsCountFrom();
                $options['floorsCountTo'] = $filter->getFloorsCountTo();

                $options['roomsCount'] = $filter->getRoomsCount();

                $options['buildingType'] = $filter->getBuildingType();
                */
                break;

            case 'house':
                $options['category'] = 'domy';
                $options['areaFrom'] = $filter->getAreaFrom();
                $options['areaTo'] = $filter->getAreaTo();

                /*
                $options['constructionYearFrom'] = $filter->getConstructionYearFrom();
                $options['constructionYearTo'] = $filter->getConstructionYearTo();

                $options['floorsCountFrom'] = $filter->getFloorsCountFrom();
                $options['floorsCountTo'] = $filter->getFloorsCountTo();

                $options['roomsCountFrom'] = $filter->getRoomsCountFrom();
                $options['roomsCountTo'] = $filter->getRoomsCountTo();

                $options['buildingType'] = $filter->getBuildingType();
                */
                break;
        }

        // sprzedaz/wynajem
        switch ($filter->getOfferType()) {
            case 0:
                $options['offerType'] = 'sprzedaz';
                break;
            case 1:
                $options['offerType'] = 'wynajem';
                break;
        }

        $options['priceFrom'] = $filter->getPriceFrom();
        $options['priceTo'] = $filter->getPriceTo();

        $options['priceAreaFrom'] = $filter->getPriceAreaFrom();
        $options['priceAreaTo'] = $filter->getPriceAreaTo();

        $options['localization']['subregion'] = $filter->getSubRegion();
        $options['localization']['region'] = $filter->getRegion();
        $options['localization']['town'] = $filter->getCity();

        $options['addedBy'] = $filter->getAddedBy();

        return $options;
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

        var_dump($choiceByCount);

        $choiceByDateLastSearch = null;
        $currentDate = new \DateTime();
        if ($choiceByCount == 'flat') {
            if ($flatFilters[0]->getDateLastSearch() !== null && $flatFilters[0]->getDateLastSearch()->add(new \DateInterval('PT'.$this->secondsToAdd)) > $currentDate) {
                if ($houseFilters[0]->getDateLastSearch() !== null && $houseFilters[0]->getDateLastSearch()->add(new \DateInterval('PT'.$this->secondsToAdd)) > $currentDate) {
                    $choiceByDateLastSearch = 'ground';
                }
                else {
                    $choiceByDateLastSearch = 'house';
                }
            }
            else {
                $choiceByDateLastSearch = 'flat';
            }
        }
        elseif ($choiceByCount == 'house') {
            if ($houseFilters[0]->getDateLastSearch() !== null && $houseFilters[0]->getDateLastSearch()->add(new \DateInterval('PT'.$this->secondsToAdd)) > $currentDate) {
                if ($flatFilters[0]->getDateLastSearch() !== null && $flatFilters[0]->getDateLastSearch()->add(new \DateInterval('PT'.$this->secondsToAdd)) > $currentDate) {
                    $choiceByDateLastSearch = 'ground';
                }
                else {
                    $choiceByDateLastSearch = 'flat';
                }
            }
            else {
                $choiceByDateLastSearch = 'house';
            }
        }
        elseif ( $choiceByCount == 'ground') {
            if ($groundFilters[0]->getDateLastSearch() !== null && $groundFilters[0]->getDateLastSearch()->add(new \DateInterval('PT'.$this->secondsToAdd)) > $currentDate) {
                if ($flatFilters[0]->getDateLastSearch() !== null && $flatFilters[0]->getDateLastSearch()->add(new \DateInterval('PT'.$this->secondsToAdd)) > $currentDate) {
                    $choiceByDateLastSearch = 'house';
                }
                else {
                    $choiceByDateLastSearch = 'flat';
                }
            }
            else {
                $choiceByDateLastSearch = 'ground';
            }
        }
        else {
            $temp = ['flat', 'house', 'ground'];
            $choiceByDateLastSearch = $temp[rand(0,2)];
        }


        $filter = null;
        var_dump($choiceByDateLastSearch);
        switch($choiceByDateLastSearch){
            case 'flat':
                $filter = $flatFilters[0];
                break;
            case 'house':
                $filter = $houseFilters[0];
                break;
            case 'ground':
                $filter = $groundFilters[0];
                break;
        }

        return $filter;
    }

}