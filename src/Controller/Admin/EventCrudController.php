<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class EventCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    public const EVENTS_BASE_PATH = 'upload/images/events';
    public const EVENTS_UPLOAD_DIR = 'public/upload/images/events';

    public static function getEntityFqcn(): string
    {
        return Event::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('libelle'),
            AssociationField::new('category'),
            ImageField::new('image')
                ->setBasePath(self::EVENTS_BASE_PATH)
                ->setUploadDir(self::EVENTS_UPLOAD_DIR)
                ->setSortable(false),
            DateField::new('date'),
            NumberField::new('placeNumber'),
            BooleanField::new('is_active'),
            TextField::new('Lieu'),
            TextEditorField::new('Description'),
            NumberField::new('Paf'),
            TextField::new('Infoline'),

        ];
    }
}
