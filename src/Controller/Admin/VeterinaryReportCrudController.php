<?php

namespace App\Controller\Admin;

use App\Entity\VeterinaryReport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VeterinaryReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VeterinaryReport::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('veterinary'),
            AssociationField::new('animal'),
            DateTimeField::new('date'),
            TextField::new('detail'),
        ];
    }
}
