<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class DataCommadn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        try{

            // $path = storage_path('app/public/countries.csv'); // Path to the CSV file in the storage folder

            // // $fileExists = Storage::exists('public/countries.csv');

            // // if ($fileExists) {
            // //     dd('rer');
            // // }
            // // dd('rere');

            // $file = new SplFileObject($path);
            // $file->setFlags(SplFileObject::READ_CSV);
            // $header = null;

            // foreach ($file as $row) {
            //     if (!$header) {
            //         $header = $row;
            //     } else {

            //         if(!isset($row[0])){
            //             continue;
            //         }

            //         $data[] = [
            //             'id' => $row[0],
            //             'name' => $row[1],
            //             'status' => "ACTIVE",
            //             "created_by" => 1,
            //         ];

            //     }
            // }

            // Country::insert($data);

            // $path = storage_path('app/public/states.csv'); // Path to the CSV file in the storage folder

            // $file = new SplFileObject($path);
            // $file->setFlags(SplFileObject::READ_CSV);
            // $header = null;

            // foreach ($file as $row) {
            //     if (!$header) {
            //         $header = $row;

            //         // dd($row);

            //     } else {

            //         if(!isset($row[0])){
            //             continue;
            //         }

            //         $data[] = [
            //             'id' => $row[0],
            //             'name' => $row[1],
            //             "country_id" => $row[2],
            //             'status' => "ACTIVE",
            //             "created_by" => 1,
            //         ];

            //         // dd($data);

            //     }
            // }

            // State::insert($data);

            // $path = storage_path('app/public/cities.csv'); // Path to the CSV file in the storage folder

            // $file = new SplFileObject($path);
            // $file->setFlags(SplFileObject::READ_CSV);
            // $header = null;

            // foreach ($file as $row) {
            //     if (!$header) {
            //         $header = $row;
            //     } else {

            //         if(!isset($row[0])){
            //             continue;
            //         }

            //         $data[] = [
            //             'id' => $row[0],
            //             'name' => $row[1],
            //             "country_id" => $row[5],
            //             "state_id" => $row[2],
            //             'status' => "ACTIVE",
            //             "created_by" => 1,
            //         ];

            //         if(count($data) > 500){
            //             City::insert($data);
            //             $data = null;
            //         }

            //     }
            // }

            $this->info('CSV data imported successfully.');

        }catch(Exception $e){
            dd($e);
        }


    }
}
