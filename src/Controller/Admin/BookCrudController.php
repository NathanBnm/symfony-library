<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Book')
            ->setEntityLabelInPlural('Books');
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('title'),
                    TextField::new('author'),
                    AssociationField::new('collection'),
                    TextareaField::new('coverFile')->setFormType(VichImageType::class),
                    AssociationField::new('chapters')->setFormTypeOption("by_reference", false),
                    AssociationField::new('resources')->setFormTypeOption("by_reference", false)

                ];
            default:
                return [
                    IdField::new('id'),
                    ImageField::new("coverName", "Cover")->setBasePath("medias/images/books/covers"),
                    TextField::new('title'),
                    TextField::new('author'),
                    AssociationField::new('collection'),
                    AssociationField::new('chapters')->setFormTypeOption("by_reference", false),
                    AssociationField::new('resources')->setFormTypeOption("by_reference", false)
                ];
        }
    }
}
