<?php

namespace Rumguru\Presenters;


use Nette\Application\BadRequestException;
use Nette\Application\UI\Form;
use Nette\Http\FileUpload;
use Rumguru\Model\Entities\Rum;
use Rumguru\Model\RumImage;
use Rumguru\Repositories\RumRepository;
use Rumguru\Repositories\RumTypeRepository;

class RumPresenter extends BasePresenter
{

    /** @var RumTypeRepository */
    private $rumTypeRepository;

    /** @var RumImage */
    private $rumImage;

    /** @var RumRepository */
    private $rumRepository;

    public function __construct(
        RumTypeRepository $rumTypeRepository,
        RumImage $rumImage,
        RumRepository $rumRepository
    )
    {
        parent::__construct();
        $this->rumTypeRepository = $rumTypeRepository;
        $this->rumImage = $rumImage;
        $this->rumRepository = $rumRepository;
    }

    public function renderDetail($rumId)
    {
        $rum = $this->rumRepository->getRumById($rumId);
        if (!$rum) {
            throw new BadRequestException;
        }
        $this->template->rum = $rum;
    }

    public function renderEditation($rumId = null)
    {
        if (!is_null($rumId)) {
            $rum = $this->rumRepository->getRumById($rumId);
            if (!$rum) {
                throw new BadRequestException;
            }

            /** @var Form $form */
            $form = $this['rumForm'];
            $form->setDefaults([
                'name' => $rum['name'],
                'description' => $rum['description'],
                'brand' => $rum['brand'],
                'country' => $rum['country'],
                'type' => $rum['type'],
                'price_from' => $rum['price_from'],
                'price_to' => $rum['price_to'],
                'age' => $rum['age'],
                'alcohol' => $rum['alcohol'],
                'color' => $rum['color'],
            ]);
        }
    }

    public function createComponentRumForm()
    {
        $form = new Form();
        $form->addText('name', 'Název rumu')
            ->setRequired('Musíte zadat název rumu.');
        $form->addTextArea('description', 'Popis');
        $form->addText('brand', 'Značka / Výrobce')
            ->setRequired('Musíte zadat značku rumu.');
        $form->addText('country', 'Země původu')
            ->setRequired('Musíte zadat zemi původu.');

        $rumTypes = [];
        $result = $this->rumTypeRepository->getRumTypes();
        foreach ($result as $type) {
            $rumTypes[$type['id']] = $type['title'];
        }
        $form->addSelect('type', 'Typ rumu', $rumTypes)
            ->setPrompt('---')
            ->setRequired('Musíte vybrat typ rumu.');

        $form->addText('price_from', 'Cena od');
        $form->addText('price_to', 'do');
        $form->addText('age', 'Staří');
        $form->addText('alcohol', '% alkoholu');
        $form->addText('color', 'Popis barvy');

        $form->addUpload('image', 'Obrázek lahve')
            ->setRequired(true)
            ->addRule(Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF.');

        $form->addSubmit('ok', 'Potvrdit');

        $form->onSuccess[] = [$this, 'rumFormSubmitted'];
        return $form;
    }

    public function rumFormSubmitted(Form $form)
    {
        $values = $form->getValues();
        /** @var FileUpload $image */
        $image = $values->image;
        $filename = $this->rumImage->saveImage($image);

        $rumEntity = new Rum();
        $rumEntity->setName($values->name);
        $rumEntity->setImage($filename);
        $rumEntity->setDescription($values->description);
        $rumEntity->setBrand($values->brand);
        $rumEntity->setCountry($values->country);
        $rumEntity->setType($values->type);
        $rumEntity->setPriceFrom($values->price_from);
        $rumEntity->setPriceTo($values->price_to);
        $rumEntity->setAge($values->age);
        $rumEntity->setAlcohol($values->alcohol);
        $rumEntity->setColor($values->color);
        $rumEntity->setScore(null);
        $rumEntity->setValidated(null);

        $this->rumRepository->insertRum($rumEntity);
        die;
    }

}