<?php

namespace App\Controller\Admin;

use App\Entity\Chapter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chapter::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Chapter')
            ->setEntityLabelInPlural('Chapters');
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('title'),
                    AssociationField::new('book'),
                    AssociationField::new('resources')->setFormTypeOption("by_reference", false)
                ];
            default:
                return [
                    IdField::new('id'),
                    TextField::new('title'),
                    AssociationField::new('book'),
                    AssociationField::new('resources')->setFormTypeOption("by_reference", false)
                ];
        }
    }
}
