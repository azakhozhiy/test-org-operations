<?php

use App\Models\Org;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orgs', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('operations', static function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 18, 4)->unsigned();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('seller_id');

            // FKs
            $org = new Org();
            $table->foreign('buyer_id')
                ->references($org->getKeyName())
                ->on($org->getTable())
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('seller_id')
                ->references($org->getKeyName())
                ->on($org->getTable())
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgs');
    }
};
