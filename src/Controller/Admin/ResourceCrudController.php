<?php

namespace App\Controller\Admin;

use App\Entity\Resource;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ResourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Resource::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Resource')
            ->setEntityLabelInPlural('Resources');
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('title'),
                    AssociationField::new('book'),
                    AssociationField::new('chapter'),
                    AssociationField::new('section'),
                    TextareaField::new('file')->setFormType(VichImageType::class)
                ];
            default:
                return [
                    IdField::new('id'),
                    TextField::new('title'),
                    AssociationField::new('book'),
                    AssociationField::new('chapter'),
                    AssociationField::new('section'),
                    ImageField::new("fileName")->setBasePath("medias/images/resources")                ];
        }
    }
}
