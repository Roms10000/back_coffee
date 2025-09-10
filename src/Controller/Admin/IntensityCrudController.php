<?php

namespace App\Controller\Admin;

use App\Entity\Intensity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IntensityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Intensity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')-> onlyOnIndex(),
            TextField::new('name')
            ->setLabel("Intensité du café"),
        ];
    }
}
