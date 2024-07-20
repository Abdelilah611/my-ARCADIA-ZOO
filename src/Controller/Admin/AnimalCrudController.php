<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('state'),
            TextField::new('weight'),
            TextField::new('size'),
            TextareaField::new('presentation'),
            ArrayField::new('race')->hideOnForm(),
            AssociationField::new('images'),
            AssociationField::new('habitat'),
            AssociationField::new('foodCons')
                ->hideOnForm(),
            AssociationField::new('vetReport')
                ->hideOnForm(),
        ];
    }
}
