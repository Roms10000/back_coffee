<?php

namespace App\Controller\Admin;

use App\Entity\Boisson;
use App\Entity\sousCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class BoissonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boisson::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id') -> onlyOnIndex(),
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('image')
            ->setBasePath('/uploads/image')
            ->setUploadDir('public/uploads/image')
            ->setLabel('image'),
            AssociationField::new('categorie')
            ->setCrudController(CategorieCrudController::class),
        ];
    }
}
