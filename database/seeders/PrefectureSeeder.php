<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prefectures')->insert([
            ['prefecture_number' => '01', 'prefecture_name' => '北海道'],
            ['prefecture_number' => '02', 'prefecture_name' => '青森県'],
            ['prefecture_number' => '03', 'prefecture_name' => '岩手県'],
            ['prefecture_number' => '04', 'prefecture_name' => '宮城県'],
            ['prefecture_number' => '05', 'prefecture_name' => '秋田県'],
            ['prefecture_number' => '06', 'prefecture_name' => '山形県'],
            ['prefecture_number' => '07', 'prefecture_name' => '福島県'],
            ['prefecture_number' => '08', 'prefecture_name' => '茨城県'],
            ['prefecture_number' => '09', 'prefecture_name' => '栃木県'],
            ['prefecture_number' => '10', 'prefecture_name' => '群馬県'],
            ['prefecture_number' => '11', 'prefecture_name' => '埼玉県'],
            ['prefecture_number' => '12', 'prefecture_name' => '千葉県'],
            ['prefecture_number' => '13', 'prefecture_name' => '東京都'],
            ['prefecture_number' => '14', 'prefecture_name' => '神奈川県'],
            ['prefecture_number' => '15', 'prefecture_name' => '新潟県'],
            ['prefecture_number' => '16', 'prefecture_name' => '富山県'],
            ['prefecture_number' => '17', 'prefecture_name' => '石川県'],
            ['prefecture_number' => '18', 'prefecture_name' => '福井県'],
            ['prefecture_number' => '19', 'prefecture_name' => '山梨県'],
            ['prefecture_number' => '20', 'prefecture_name' => '長野県'],
            ['prefecture_number' => '21', 'prefecture_name' => '岐阜県'],
            ['prefecture_number' => '22', 'prefecture_name' => '静岡県'],
            ['prefecture_number' => '23', 'prefecture_name' => '愛知県'],
            ['prefecture_number' => '24', 'prefecture_name' => '三重県'],
            ['prefecture_number' => '25', 'prefecture_name' => '滋賀県'],
            ['prefecture_number' => '26', 'prefecture_name' => '京都府'],
            ['prefecture_number' => '27', 'prefecture_name' => '大阪府'],
            ['prefecture_number' => '28', 'prefecture_name' => '兵庫県'],
            ['prefecture_number' => '29', 'prefecture_name' => '奈良県'],
            ['prefecture_number' => '30', 'prefecture_name' => '和歌山県'],
            ['prefecture_number' => '31', 'prefecture_name' => '鳥取県'],
            ['prefecture_number' => '32', 'prefecture_name' => '島根県'],
            ['prefecture_number' => '33', 'prefecture_name' => '岡山県'],
            ['prefecture_number' => '34', 'prefecture_name' => '広島県'],
            ['prefecture_number' => '35', 'prefecture_name' => '山口県'],
            ['prefecture_number' => '36', 'prefecture_name' => '徳島県'],
            ['prefecture_number' => '37', 'prefecture_name' => '香川県'],
            ['prefecture_number' => '38', 'prefecture_name' => '愛媛県'],
            ['prefecture_number' => '39', 'prefecture_name' => '高知県'],
            ['prefecture_number' => '40', 'prefecture_name' => '福岡県'],
            ['prefecture_number' => '41', 'prefecture_name' => '佐賀県'],
            ['prefecture_number' => '42', 'prefecture_name' => '長崎県'],
            ['prefecture_number' => '43', 'prefecture_name' => '熊本県'],
            ['prefecture_number' => '44', 'prefecture_name' => '大分県'],
            ['prefecture_number' => '45', 'prefecture_name' => '宮崎県'],
            ['prefecture_number' => '46', 'prefecture_name' => '鹿児島県'],
            ['prefecture_number' => '47', 'prefecture_name' => '沖縄県'],
        ]);
    }
}
