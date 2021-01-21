<?php

namespace App\Controller\Admin;

use App\Entity\BookCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookCollectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookCollection::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Collection')
            ->setEntityLabelInPlural('Collections');
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('title'),
                    AssociationField::new('books')->setFormTypeOption("by_reference", false)
                ];
            default:
                return [
                    IdField::new('id'),
                    TextField::new('title'),
                    AssociationField::new('books')->setFormTypeOption("by_reference", false)
                ];
        }
    }
}
