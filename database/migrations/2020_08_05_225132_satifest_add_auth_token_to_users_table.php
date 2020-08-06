<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Satifest\Foundation\Satifest;
use function Satifest\Foundation\table_name;

class SatifestAddAuthTokenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = $this->getUserTable();
        $columnName = Satifest::getAuthTokenName();

        if (! Schema::hasColumn($tableName, $columnName)) {
            Schema::table($tableName, function (Blueprint $table) use ($columnName) {
                $table->string($columnName, 80)
                    ->after('password')
                    ->unique()
                    ->nullable()
                    ->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = $this->getUserTable();
        $columnName = Satifest::getAuthTokenName();

        if (Schema::hasColumn($tableName, $columnName)) {
            Schema::table($this->getUserTable(), function (Blueprint $table) use ($columnName) {
                $table->dropColumn($columnName);
            });
        }
    }

    /**
     * Get the actual users table.
     */
    protected function getUserTable(): string
    {
        return table_name(Satifest::getUserModel());
    }
}
