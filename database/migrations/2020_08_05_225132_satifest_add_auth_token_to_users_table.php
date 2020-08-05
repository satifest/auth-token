<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Satifest\Foundation\Satifest;
use function Satifest\table_name;

class SatifestAddAuthTokenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getUserTable(), function (Blueprint $table) {
            $table->string(Satifest::getAuthTokenName(), 80)
                ->after('password')
                ->unique()
                ->nullable()
                ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->getUserTable(), function (Blueprint $table) {
            $table->dropColumn(Satifest::getAuthTokenName());
        });
    }

    /**
     * Get the actual users table.
     */
    protected function getUserTable(): string
    {
        return table_name(Satifest::getUserModel());
    }
}
