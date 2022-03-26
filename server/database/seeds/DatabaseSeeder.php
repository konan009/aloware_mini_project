<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert(
            [
                [
                    'comment_desc'  => 'Comment 1',
                    'comment_by'    => 'Meljohn',
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'comment_desc'  => 'Comment 2',
                    'comment_by'    => 'Marhian',
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'comment_desc'  => 'Comment 3',
                    'comment_by'    => 'Eleonor',
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'comment_desc'  => 'Comment 4',
                    'comment_by'    => 'Anj',
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'comment_desc'  => 'Comment 5',
                    'comment_by'    => 'Eleonor',
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ]
        );

        DB::table('comments_parent_child')->insert(
            [
                [ 
                    'parent_id' => 1,
                    'child_id'  => 1
                ],
                [
                    'parent_id' => 1,
                    'child_id'  => 3
                ],
                [
                    'parent_id' => 1,
                    'child_id'  => 4
                ],
                [
                    'parent_id' => 3,
                    'child_id'  => 3
                ],
                [
                    'parent_id' => 3,
                    'child_id'  => 4
                ],
                [
                    'parent_id' => 4,
                    'child_id'  => 4
                ],
                [
                    'parent_id' => 2,
                    'child_id'  => 2
                ],
                [
                    'parent_id' => 2,
                    'child_id'  => 5
                ],
                [
                    'parent_id' => 5,
                    'child_id'  => 5
                ]
            ]
        );
    }
}
