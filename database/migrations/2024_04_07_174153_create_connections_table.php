<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        Schema::create('connections', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->id();
            $table->string('clientName');
            $table->string('protocol');
            $table->string('host');
            $table->string('login');
            $table->string('password');
            $table->integer('port');
            $table->string('note');
            $table->timestamps();

            $table->softDeletes();
        });

//        foreach (range(1,34) as $rg) {
//            DB::table('connections')->insert([
//                'clientName' => $faker->fruitName,
//                'host' => $faker->fruitName,
//                'login' => $faker->fruitName,
//                'password' => $faker->fruitName,
//                'port' => $faker->numberBetween(100,900),
//                'note' => $faker->fruitName,
//                'protocol' => 'sftp',
//            ]);
//        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
