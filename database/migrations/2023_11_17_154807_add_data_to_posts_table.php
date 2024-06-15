<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('levels',400);
        });
        $array = [
            ['name' => 'greenColorLight','value' => '#3eba03'],
            ['name' => 'redColorLight','value' => '#f00000'],
            ['name' => 'backColorLight1','value' => '#eeeeee'],
            ['name' => 'headerColorLight','value' => '#ffffff'],
            ['name' => 'headerColor2Light','value' => '#F1F4F9'],
            ['name' => 'widgetColorLight','value' => '#ffffff'],
            ['name' => 'singleColorLight','value' => '#ffffff'],
            ['name' => 'greenColorDark','value' => '#3eba03'],
            ['name' => 'redColorDark','value' => '#f00000'],
            ['name' => 'backColorDark1','value' => '#06283D'],
            ['name' => 'headerColorDark','value' => '#041C32'],
            ['name' => 'headerColor2Dark','value' => '#0E2338'],
            ['name' => 'widgetColorDark','value' => '#041C32'],
            ['name' => 'singleColorDark','value' => '#041C32'],
            ['name' => 'messageTrack','value' => ''],
            ['name' => 'samansep','value' => ''],
            ['name' => 'statusSaman','value' => '1'],
            ['name' => 'languageStatus','value' => '1'],
            ['name' => 'darkStatus','value' => '1'],
        ];
        foreach ($array as $item) {
            DB::table('settings')->insert(
                array(
                    'key' => $item['name'],
                    'value' => $item['value'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
