<?php

namespace App\Filament\Resources\FilmResource\Pages;

use App\Filament\Resources\FilmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFilm extends EditRecord
{
    protected static string $resource = FilmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['trailer'] = 'https://www.youtube.com/watch?v=' . $data['trailer'];

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $url = parse_url($data['trailer'], PHP_URL_QUERY);
        parse_str($url, $params);
        $data['trailer'] = $params['v'] ?? '';

        return $data;
    }
}
