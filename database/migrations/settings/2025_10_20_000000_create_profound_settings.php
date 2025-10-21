<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('profound.enabled', false);
        $this->migrator->add('profound.api_key', "");
    }

    public function down()
    {
        $this->migrator->delete('profound.enabled');
        $this->migrator->delete('profound.api_key');
    }
};
