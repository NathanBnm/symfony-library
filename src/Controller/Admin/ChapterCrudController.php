<?php

namespace App\Controller\Admin;

use App\Entity\Chapter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * Class ChapterCrudController
 * @package App\Controller\Admin
 */
class ChapterCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Chapter::class;
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Chapter')
            ->setEntityLabelInPlural('Chapters');
    }

    /**
     * @param string $pageName
     * @return iterable
     */
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
