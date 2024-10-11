<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueCodeToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('unique_code', 4)->unique()->after('unique_user_id')->nullable();
        });

        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $uniqueCode = $this->generateUniqueCode();
            while ($this->isCodeExists($uniqueCode)) {
                $uniqueCode = $this->generateUniqueCode();
            }
            $this->updateUniqueCode($user->id, $uniqueCode);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('unique_code');
        });
    }


     private function generateUniqueCode()
    {
        return str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    private function isCodeExists($code)
    {
        return DB::table('users')->where('unique_code', $code)->exists();
    }

    private function updateUniqueCode($userId, $uniqueCode)
    {
        DB::table('users')->where('id', $userId)->update(['unique_code' => $uniqueCode]);
    }

}
