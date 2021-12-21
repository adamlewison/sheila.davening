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

    public static function sponsor_info() {

        $data = [];
        $headers = ['tefillah', 'category', 'nusach', 'first_name', 'last_name', 'email', 'sponsor_by', 'merit_of', 'show_on_app'];

        foreach (Prayer::all() as $prayer) {

            foreach ($prayer->items as $item) {

                $row = [
                    'tefillah'      => $prayer->prayer,
                    'category'      => $prayer->category,
                    'nusach'        => Item::NUSACH[$item->nusach],
                    'first_name'    => 'NA',
                    'last_name'     => 'NA',
                    'email'         => 'NA',
                    'sponsor_by'    => 'NA',
                    'merit_of'      => 'NA',
                    'show_on_app'   => 'NA'
                ];

                if ($item->purchased()) {
                    $details            = $item->purchaseDetails();
                    $row['first_name']  = $details->first_name;
                    $row['last_name']   = $details->last_name;
                    $row['email']       = $details->email;
                    $row['sponsor_by']  = $details->sponsor_by;
                    $row['merit_of']    = $details->merit_of;
                    $row['show_on_app'] = $details->show_on_app;
                }

                $data[] = $row;
            }
        }



        foreach (array_merge([$headers], $data) as $fields) {
            print (implode(',' , $fields)) . "<br/>";
        }



        //dd($data);
    }
}
