<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Prayer;

class PrayerService {

    public static function fill_tables() {

        Prayer::query()->delete();
        Item::query()->delete();

        $data = [];
        $f = file(storage_path('data/book.csv'));
        $data = [];

        $header = $f[0];
        unset($f[0]);
        foreach ($f as $line) {
            $line = str_getcsv($line, ';');
            if (!empty($line[0])) {
                $data[] = $line;
                $nusach = $line[2] - 1;
                $price = $line[4];

                if (empty($price)) {
                    $price = 1800;
                }

                print($nusach);
                $p = Prayer::create([
                    'prayer' => $line[0],
                    'category' => $line[1],
                    //'show_name' => $line[3],
                    'price' => $price
                ]);

                if ($nusach == 0) {
                    $p->items()->create(['nusach' => 1, 'price' => $price]);
                    $p->items()->create(['nusach' => 2, 'price' => $price]);
                } else {
                    $p->items()->create(['nusach' => $nusach, 'price' => $price]);
                }

            }
        }

        //dd(Prayer::all()->pluck('nusach'));
        //return $data;
    }

}
