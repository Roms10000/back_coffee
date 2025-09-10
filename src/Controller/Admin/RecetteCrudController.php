<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use App\Entity\Boisson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    public function configureFields(string $pageName): iterable
    {
    return [
        IdField::new('id')->onlyOnIndex(),

        AssociationField::new('boisson')
            ->setCrudController(BoissonCrudController::class),

        TextEditorField::new('info')
            ->formatValue(function ($value, $entity) {
                return strip_tags($value);
            }),

        TextEditorField::new('etape')
            ->formatValue(function ($value, $entity) {
                return strip_tags($value);
            }),
    ];
    }
}
