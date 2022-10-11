<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \DB::table('users')->insert([
            ['name' => 'Toithietke', 'email' => Str::random(10).'@gmail.com', 'email_verified_at' => gmdate('Y-m-d h:i:s', time()), 'password' => bcrypt('Toithietke'), 'api_token' => Str::random(80), 'remember_token' => Str::random(10), 'level' => 1,'avatar'=>'defaultAvatar.svg','cover'=>'defaultCover.svg'],
            ['name' => 'Admin', 'email' => 'tottranrotate@gmail.com', 'email_verified_at' => gmdate('Y-m-d h:i:s', time()), 'password' => bcrypt('Admin@123'), 'api_token' => Str::random(80), 'remember_token' => Str::random(10), 'level' => 1,'avatar'=>'defaultAvatar.svg','cover'=>'defaultCover.svg'],
            ['name' => 'User', 'email' => Str::random(10).'@gmail.com', 'email_verified_at' => gmdate('Y-m-d h:i:s', time()), 'password' => bcrypt('User@123'), 'api_token' => Str::random(80), 'remember_token' => Str::random(10), 'level' => 2,'avatar'=>'defaultAvatar.svg','cover'=>'defaultCover.svg'],
            ['name' => 'Guest', 'email' => Str::random(10).'@gmail.com', 'email_verified_at' => gmdate('Y-m-d h:i:s', time()), 'password' => bcrypt('Guest@123'), 'api_token' => Str::random(80), 'remember_token' => Str::random(10), 'level' => 0,'avatar'=>'defaultAvatar.svg','cover'=>'defaultCover.svg'],
        ]);
        \DB::table('TheLoai')->insert([
            ['id' => 1, 'Ten' => 'Giáo Dục', 'TenKhongDau' => 'Giao Duc'],
            ['id' => 2, 'Ten' => 'Sức Khoẻ', 'TenKhongDau' => 'Suc Khoe'],
            ['id' => 3, 'Ten' => 'Đời Sống', 'TenKhongDau' => 'Doi Song'],
            ['id' => 4, 'Ten' => 'Du Lịch', 'TenKhongDau' => 'Du Lich'],
            ['id' => 5, 'Ten' => 'Hài', 'TenKhongDau' => 'Hai'],
            ['id' => 6, 'Ten' => 'Âm Nhạc', 'TenKhongDau' => 'Am Nhac'],
            ['id' => 7, 'Ten' => 'Võ Thuật', 'TenKhongDau' => 'Vo Thuat'],
        ]);
        \DB::table('LoaiTin')->insert([
            ['id' => 1, 'idTheLoai' => 1, 'Ten' => 'Học Tiếng Anh', 'TenKhongDau' => 'Hoc Tieng Anh'],
            ['id' => 2, 'idTheLoai' => 1, 'Ten' => 'Học Lập Trình', 'TenKhongDau' => 'Hoc Lap Trinh'],
            ['id' => 3, 'idTheLoai' => 2, 'Ten' => 'Bệnh Xương Khớp', 'TenKhongDau' => 'Benh Xuong Khop'],
            ['id' => 4, 'idTheLoai' => 7, 'Ten' => 'Võ Hàn Quốc', 'TenKhongDau' => 'Vo Han Quoc'],
            ['id' => 5, 'idTheLoai' => 7, 'Ten' => 'Võ Việt Nam', 'TenKhongDau' => 'Vo Viet Nam'],
        ]);
        \DB::table('TinTuc')->insert([
            ['id' => 1, 'idLoaiTin' => 2, 'TieuDe' => 'Html', 'TieuDeKhongDau' => 'Html', 'TomTat' => 'Học & Thực hành Html', 'NoiDung' => 'Học & Thực hành Html', 'NoiBat' => 1],
            ['id' => 2, 'idLoaiTin' => 2, 'TieuDe' => 'Css', 'TieuDeKhongDau' => 'Css', 'TomTat' => 'Học & Thực hành Css', 'NoiDung' => 'Học & Thực hành Css', 'NoiBat' => 1],
            ['id' => 3, 'idLoaiTin' => 2, 'TieuDe' => 'Javascript', 'TieuDeKhongDau' => 'Javascript', 'TomTat' => 'Học & Thực hành Javascript', 'NoiDung' => 'Học & Thực hành Javascript', 'NoiBat' => 1],
            ['id' => 4, 'idLoaiTin' => 2, 'TieuDe' => 'Php', 'TieuDeKhongDau' => 'Php', 'TomTat' => 'Học & Thực hành Javascript', 'NoiDung' => 'Học & Thực hành Javascript', 'NoiBat' => 1],
            ['id' => 5, 'idLoaiTin' => 2, 'TieuDe' => 'Laravel', 'TieuDeKhongDau' => 'Laravel', 'TomTat' => 'Học & Thực hành Javascript', 'NoiDung' => 'Học & Thực hành Javascript', 'NoiBat' => 1],
            ['id' => 6, 'idLoaiTin' => 2, 'TieuDe' => 'NodeJs', 'TieuDeKhongDau' => 'NodeJs', 'TomTat' => 'Học & Thực hành Javascript', 'NoiDung' => 'Học & Thực hành Javascript', 'NoiBat' => 1],
            ['id' => 7, 'idLoaiTin' => 2, 'TieuDe' => 'OOP', 'TieuDeKhongDau' => 'OOP', 'TomTat' => 'Học & Thực hành Javascript', 'NoiDung' => 'Học & Thực hành Javascript', 'NoiBat' => 1],
        ]);
        \DB::table('Comment')->insert([
            ['NoiDung' => 'Hello man', 'idUser' => 1, 'idTinTuc' => 1],
            ['NoiDung' => 'Hello man 2', 'idUser' => 1, 'idTinTuc' => 1],
            ['NoiDung' => 'Hello man 3', 'idUser' => 1, 'idTinTuc' => 1],
        ]);
        \DB::table('Slide')->insert([
            ['Ten'=>'Slide 1','NoiDung' => 'Hello man', 'Link' => '#', 'Hinh' => 'Yk3B_images (2).jpeg'],
            ['Ten'=>'Slide 2','NoiDung' => 'Hello man 2', 'Link' => '#', 'Hinh' => 'Yk3B_images (2).jpeg'],
            ['Ten'=>'Slide 3','NoiDung' => 'Hello man 3', 'Link' => '#', 'Hinh' => 'Yk3B_images (2).jpeg'],
        ]);
    }
}
