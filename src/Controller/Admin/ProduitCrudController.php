<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id') -> onlyOnIndex(),
            TextField::new('name'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            NumberField::new('intensity'),
            TextField::new('origin'),
            ImageField::new('image')
            ->setBasePath('/uploads/image')
            ->setUploadDir('public/uploads/image')
            ->setLabel('image')
        ];
    }
}
