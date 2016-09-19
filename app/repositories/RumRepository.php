<?php

namespace Rumguru\Repositories;


use Nette\Utils\DateTime;
use Rumguru\Model\Entities\Rum;

class RumRepository extends BaseRepository
{

    public function getRumsToHomepage()
    {
        return $this->database->table('rum')->order('created')->limit('10')->fetchAll();
    }

    public function getRumById($rumId)
    {
        return $this->database->table('rum')->where('id', $rumId)->fetch();
    }

    public function insertRum(Rum $rum)
    {
        $data = [
            'name' => $rum->getName(),
            'image' => $rum->getImage(),
            'description' => $rum->getDescription(),
            'brand_id' => $this->getBrandId($rum->getBrand()),
            'country_id' => $this->getCountryId($rum->getCountry()),
            'type' => $rum->getType(),
            'price_from' => $rum->getPriceFrom(),
            'price_to' => $rum->getPriceTo(),
            'age' => $rum->getAge(),
            'alcohol' => $rum->getAlcohol(),
            'color' => $rum->getColor(),
            'score' => $rum->getScore(),
            'validated' => $rum->getValidated(),
            'created' => new DateTime(),
        ];

        $this->database->table('rum')->insert($data);
    }

    private function getBrandId($brand)
    {
        $row = $this->database->table('brands')->where('name', trim($brand))->fetch();

        if (!$row) {
            $data = [
                'name' => $brand
            ];
            $row = $this->database->table('brands')->insert($data);
        }
        return $row['id'];
    }

    private function getCountryId($country)
    {
        $row = $this->database->table('countries')->where('name', trim($country))->fetch();

        if (!$row) {
            $data = [
                'name' => $country
            ];
            $row = $this->database->table('countries')->insert($data);
        }
        return $row['id'];
    }

}