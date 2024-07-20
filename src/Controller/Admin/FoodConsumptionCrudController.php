<?php

namespace App\Controller\Admin;

use App\Entity\FoodConsumption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FoodConsumptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FoodConsumption::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('employee'),
            AssociationField::new('animal'),
            DateTimeField::new('date'),
            TextField::new('detail'),
        ];
    }
}
