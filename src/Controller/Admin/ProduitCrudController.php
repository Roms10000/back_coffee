<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Boisson;
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
            TextField::new('name')
            ->setLabel('Nom'),
            TextEditorField::new('description'),
            NumberField::new('price')
            ->setLabel('Prix en €'),
            NumberField::new('intensity')
            ->setLabel('Intensité du café /10'),
            TextField::new('origin')
            ->setLabel('Origine'),
            ImageField::new('image')
            ->setBasePath('/uploads/image')
            ->setUploadDir('public/uploads/image')
            ->setLabel('Image')
        ];
    }
}
