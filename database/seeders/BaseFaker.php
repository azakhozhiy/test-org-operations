<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Faker\Generator;

class BaseFaker
{
    private static ?Generator $faker = null;

    public static function faker(): Generator
    {
        if (self::$faker === null) {
            self::$faker = FakerFactory::create('en_EN');
        }

        return self::$faker;
    }
}
