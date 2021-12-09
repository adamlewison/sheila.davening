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

                print($nusach);
                $p = Prayer::create([
                    'prayer' => $line[0],
                    'category' => $line[1],
                    //'show_name' => $line[3],
                    'price' => $line[4]
                ]);

                if ($nusach == 0) {
                    $p->items()->create(['nusach' => 1, 'price' => $line[4]]);
                    $p->items()->create(['nusach' => 2, 'price' => $line[4]]);
                } else {
                    $p->items()->create(['nusach' => $nusach, 'price' => $line[4]]);
                }

            }
        }

        //dd(Prayer::all()->pluck('nusach'));
        //return $data;
    }

}
