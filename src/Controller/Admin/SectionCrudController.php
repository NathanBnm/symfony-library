<?php

namespace App\Controller\Admin;

use App\Entity\Section;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Section::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Section')
            ->setEntityLabelInPlural('Sections');
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('title'),
                    AssociationField::new('chapter'),
                    AssociationField::new('section'),
                    AssociationField::new('sections')->setFormTypeOption("by_reference", false),
                    AssociationField::new('resources')->setFormTypeOption("by_reference", false)
                ];
            default:
                return [
                    IdField::new('id'),
                    TextField::new('title'),
                    AssociationField::new('chapter'),
                    AssociationField::new('section'),
                    AssociationField::new('sections')->setFormTypeOption("by_reference", false),
                    AssociationField::new('resources')->setFormTypeOption("by_reference", false)
                ];
        }
    }
}
