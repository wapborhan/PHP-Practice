<?php

use Illuminate\Database\Seeder;
use App\AdminTheme;

class AdminThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $theme = new AdminTheme();
        $theme->name = 'main';
        $theme->title = 'Main Theme';
        $theme->active = 1;
        $theme->save();

        $theme = new AdminTheme();
        $theme->name = 'news';
        $theme->title = 'News Theme';
        $theme->active = 0;
        $theme->save();
    }
}
