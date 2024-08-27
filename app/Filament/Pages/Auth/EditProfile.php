<?php
 
namespace App\Filament\Pages\Auth;
 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
 
class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->numeric(),
                $this->getNameFormComponent(),
<<<<<<< HEAD
                // $this->getEmailFormComponent(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                // $this->getPasswordConfirmationFormComponent(),
=======
                $this->getEmailFormComponent(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                // $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
>>>>>>> origin/main
            ]);
    }
}