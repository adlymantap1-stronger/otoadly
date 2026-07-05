<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            ['brand' => 'Toyota', 'model' => 'Avanza', 'year' => 2020, 'price' => 165000000, 'mileage' => 42000, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'Kondisi sangat baik, terawat, AC dingin, surat lengkap.'],
            ['brand' => 'Honda', 'model' => 'Brio Satya E', 'year' => 2021, 'price' => 142000000, 'mileage' => 18500, 'transmission' => 'manual', 'fuel_type' => 'bensin', 'description' => 'Kilometer rendah, mesin halus, ban baru, siap pakai.'],
            ['brand' => 'Mitsubishi', 'model' => 'Xpander Ultimate', 'year' => 2020, 'price' => 215000000, 'mileage' => 30200, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'Full ori, interior bersih, fitur lengkap.'],
            ['brand' => 'Suzuki', 'model' => 'Ertiga GX', 'year' => 2019, 'price' => 155000000, 'mileage' => 55000, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'Keluarga 7 seater, AC double blower, surat panjang.'],
            ['brand' => 'Daihatsu', 'model' => 'Ayla X', 'year' => 2022, 'price' => 118000000, 'mileage' => 12000, 'transmission' => 'manual', 'fuel_type' => 'bensin', 'description' => 'Irit BBM, cocok untuk dalam kota, mulus tanpa lecet.'],
            ['brand' => 'Honda', 'model' => 'HR-V E CVT', 'year' => 2019, 'price' => 235000000, 'mileage' => 48000, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'SUV stylish, panoramic sunroof, kondisi prima.'],
            ['brand' => 'Toyota', 'model' => 'Rush TRD', 'year' => 2021, 'price' => 248000000, 'mileage' => 25000, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'SUV sporty, full aksesori TRD, surat lengkap panjang.'],
            ['brand' => 'Nissan', 'model' => 'Livina SV', 'year' => 2018, 'price' => 138000000, 'mileage' => 67000, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'MPV 7 seater, mesin kencang, AC dingin, siap pakai.'],
            ['brand' => 'Wuling', 'model' => 'Almaz RS', 'year' => 2022, 'price' => 285000000, 'mileage' => 15000, 'transmission' => 'matic', 'fuel_type' => 'bensin', 'description' => 'SUV modern, layar besar, fitur canggih, km rendah.'],
            ['brand' => 'Toyota', 'model' => 'Innova Reborn G', 'year' => 2020, 'price' => 320000000, 'mileage' => 38000, 'transmission' => 'matic', 'fuel_type' => 'diesel', 'description' => 'Raja jalanan, diesel irit, kabin luas, surat lengkap.'],
        ];

        foreach ($cars as $car) {
            Car::create(array_merge($car, [
                'user_id' => 1,
                'status'  => 'available',
            ]));
        }
    }
}