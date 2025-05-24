<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ManageGeneral extends SettingsPage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $title = 'General Settings';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Settings')
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                    ])
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->required(),
                        FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->maxSize(100)
                            ->disk('public')
                            ->directory('system')
                            ->getUploadedFileNameForStorageUsing(
                                function ($file): string {
                                    return 'favicon.' . $file->getClientOriginalExtension();
                                }
                            ),
                        FileUpload::make('site_logo')
                            ->label('Site Logo')
                            ->image()
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('system')
                            ->getUploadedFileNameForStorageUsing(
                                function ($file): string {
                                    return 'site-logo.' . $file->getClientOriginalExtension();
                                }
                            )
                            ->optimize('webp'),
                        FileUpload::make('dark_site_logo')
                            ->label('Dark Site Logo')
                            ->image()
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('system')
                            ->getUploadedFileNameForStorageUsing(
                                function ($file): string {
                                    return 'dark-site-logo.' . $file->getClientOriginalExtension();
                                }
                            )
                            ->optimize('webp'),
                        Toggle::make('site_active')
                            ->label('Site Active'),
                        Toggle::make('registration_enabled')
                            ->label('Registration Enabled'),
                        Toggle::make('password_reset_enabled')
                            ->label('Password Reset Enabled'),
                        Toggle::make('sso_enabled')
                            ->label('SSO Enabled'),
                    ])
            ]);
    }
}
