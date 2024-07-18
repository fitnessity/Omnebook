<?php

use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Migrations\Migration;

class RegisterEnumType extends Migration
{
    public function up()
    {
        if (!Type::hasType('enum')) {
            Type::addType('enum', \Doctrine\DBAL\Types\StringType::class);
        }
    }

    public function down()
    {
        // No need to remove the type on rollback
    }
}
