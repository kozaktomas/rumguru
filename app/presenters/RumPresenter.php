<?php

namespace Rumguru\Presenters;


use Nette\Application\UI\Form;
use Nette\Http\FileUpload;
use Rumguru\Model\RumImage;
use Rumguru\Repositories\RumTypeRepository;

class RumPresenter extends BasePresenter
{

    /** @var RumTypeRepository */
    private $rumTypeRepository;

    /** @var RumImage */
    private $rumImage;

    public function __construct(RumTypeRepository $rumTypeRepository, RumImage $rumImage)
    {
        parent::__construct();
        $this->rumTypeRepository = $rumTypeRepository;
        $this->rumImage = $rumImage;
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
        dump($filename);die;
    }

}