<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('primary_categories')->insert([
            [
                'name' => '営業',
                'sort_order' => 1,
            ],
            [
                'name' => '企画・経営',
                'sort_order' => 2,
            ],
            [
                'name' => '管理・事務',
                'sort_order' => 3,
            ],
            [
                'name' => '販売・フード・アミューズメント',
                'sort_order' => 4,
            ],
            [
                'name' => 'ITエンジニア',
                'sort_order' => 5,
            ],
        ]);   

        DB::table('secondary_categories')->insert([
            [
                'name' => '営業・企画営業(法人向け)',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => '営業・企画営業(個人向け)',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => '営業マネジャー・営業管理職',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],
            [
                'name' => '代理店営業・パートナーセールス',
                'sort_order' => 4,
                'primary_category_id' => 1
            ],
            [
                'name' => 'マーケティングリサーチ・分析',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],
            [
                'name' => '商品企画・商品開発',
                'sort_order' => 6,
                'primary_category_id' => 2
            ],
            [
                'name' => '広告宣伝',
                'sort_order' => 7,
                'primary_category_id' => 2
            ],
            [
                'name' => '仕入れ・バイヤー',
                'sort_order' => 8,
                'primary_category_id' => 2
            ],
            [
                'name' => '経理・財務',
                'sort_order' => 9,
                'primary_category_id' => 3
            ],
            [
                'name' => '会計・税務',
                'sort_order' => 10,
                'primary_category_id' => 3
            ],
            [
                'name' => '総務',
                'sort_order' => 11,
                'primary_category_id' => 3
            ],
            [
                'name' => '広報',
                'sort_order' => 12,
                'primary_category_id' => 3
            ],
            [
                'name' => '教育・研修トレーナー',
                'sort_order' => 13,
                'primary_category_id' => 4
            ],
            [
                'name' => '美容部員',
                'sort_order' => 14,
                'primary_category_id' => 4
            ],
            [
                'name' => 'ホール・フロアスタッフ',
                'sort_order' => 15,
                'primary_category_id' => 4
            ],
            [
                'name' => '調理・調理補助',
                'sort_order' => 16,
                'primary_category_id' => 4
            ],
            [
                'name' => 'プログラマー (WEB・オープン・モバイル系)',
                'sort_order' => 17,
                'primary_category_id' => 5
            ],
            [
                'name' => 'システムエンジニア (アプリ設計)',
                'sort_order' => 18,
                'primary_category_id' => 5
            ],
            [
                'name' => 'システムエンジニア (DB設計)',
                'sort_order' => 19,
                'primary_category_id' => 5
            ],
            [
                'name' => 'ネットワーク運用',
                'sort_order' => 20,
                'primary_category_id' => 5
            ],
        ]);   
    }
}
