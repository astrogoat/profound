<?php

namespace Astrogoat\Profound\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class ProfoundSettings extends AppSettings
{
    public string $api_key;

    public function rules(): array
    {
        return [
           'api_key' => Rule::requiredIf($this->enabled === true),
        ];
    }

    public function description(): string
    {
        return 'Interact with Profound.';
    }

    public static function group(): string
    {
        return 'profound';
    }
}
