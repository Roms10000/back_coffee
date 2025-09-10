<?php

namespace App\Controller\Admin;

use App\Entity\Boisson;
use App\Entity\Categorie;
use App\Entity\Type;
use App\Entity\Intensity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;


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
            TextEditorField::new('description')
            ->formatValue(function ($value, $entity) {
             return strip_tags($value);
            }),
            NumberField::new('note')
            ->setLabel('Note /10'),
            ImageField::new('image')
            ->setBasePath('/uploads/image')
            ->setUploadDir('public/uploads/image')
            ->setLabel('image'),
            AssociationField::new('categorie')
            ->setCrudController(CategorieCrudController::class),
            AssociationField::new('type')
            ->setCrudController(IntensityCrudController::class),
            AssociationField::new('intensity')
            ->setLabel('Intensité')
            ->setCrudController(TypeCrudController::class),
        ];
    }
}
