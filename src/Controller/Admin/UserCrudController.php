<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users');
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_NEW:
                return [
                    TextField::new('firstname'),
                    TextField::new('lastname'),
                    EmailField::new('email'),
                    TextField::new('password')->setFormType(PasswordType::class)
                ];
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('firstname'),
                    TextField::new('lastname'),
                    EmailField::new('email')
                ];
            default:
                return [
                    IdField::new('id'),
                    TextField::new('firstname'),
                    TextField::new('lastname'),
                    EmailField::new('email')
                ];
        }
    }
}
