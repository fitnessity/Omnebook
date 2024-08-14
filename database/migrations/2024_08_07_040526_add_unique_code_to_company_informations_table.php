<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueCodeToCompanyInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            //
            $table->string('unique_code', 6)->unique()->after('user_id')->nullable();
        });
        $users = DB::table('company_informations')->get();
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
        Schema::table('company_informations', function (Blueprint $table) {
            //
        });
    }
    private function generateUniqueCode()
    {
        return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    private function isCodeExists($code)
    {
        return DB::table('company_informations')->where('unique_code', $code)->exists();
    }

    private function updateUniqueCode($userId, $uniqueCode)
    {
        DB::table('company_informations')->where('id', $userId)->update(['unique_code' => $uniqueCode]);
    }
}
