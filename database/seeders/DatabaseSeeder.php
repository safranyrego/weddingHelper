<?php

namespace Database\Seeders;

use App\Enums\TodoStatuses;
use App\Models\Budget;
use App\Models\Item;
use App\Models\Todo;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Test',
            'email' => 'test@weddinghelper.test',
            'password' => Hash::make('password')
        ]);

        $wedding = Wedding::create([
            'user_id' => $user->id,
            'title' => 'Esküjólesz',
            'final' => now()->addMonth(),
        ]);

        Todo::createTodoListForNewWedding($wedding->id);

        foreach ($wedding->todos as $todo) {
            $todo->update([
                'status' => TodoStatuses::cases()[rand(0,3)]->value
            ]);
        }

        $budget = Budget::create([
            'wedding_id' => $wedding->id,
            'value' => 3500000,
        ]);

        $budget->items()->createMany([
            [
                'title' => 'Étterem',
                'value' => 600000,
            ],[
                'title' => 'Vőlegény öltözéke',
                'value' => 200000,
            ],[
                'title' => 'Menyasszony öltözéke',
                'value' => 300000,
            ],[
                'title' => 'Gyűrűk',
                'value' => 350000,
            ]
        ]);

        $wedding->events()->createMany([
            [
                'title' => 'Reggeli',
                'starts_at' => date("H:i:s", strtotime('7:00')),
            ],[
                'title' => 'Öltözködés',
                'starts_at' => date("H:i:s", strtotime('8:00')),
            ],[
                'title' => 'Kreatív fotózás',
                'starts_at' => date("H:i:s", strtotime('9:15')),
            ],[
                'title' => 'Ebéd',
                'starts_at' => date("H:i:s", strtotime('12:30')),
            ],[
                'title' => 'Egyházi szertartás',
                'starts_at' => date("H:i:s", strtotime('16:00')),
            ],[
                'title' => 'Lagzi',
                'starts_at' => date("H:i:s", strtotime('18:30')),
            ],[
                'title' => 'Tortavágás',
                'starts_at' => date("H:i:s", strtotime('23:00')),
            ]
        ]);

        $wedding->ideas()->createMany([
            [
                'unsplash_id' => 'M2T1j-6Fn8w',
                'urls' => json_decode('{"raw": "https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHw1fHx3ZWRkaW5nfGVufDB8fHx8MTY4MzQ3NDc3MQ&ixlib=rb-4.0.3", "full": "https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?crop=entropy&cs=srgb&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHw1fHx3ZWRkaW5nfGVufDB8fHx8MTY4MzQ3NDc3MQ&ixlib=rb-4.0.3&q=85", "small": "https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHw1fHx3ZWRkaW5nfGVufDB8fHx8MTY4MzQ3NDc3MQ&ixlib=rb-4.0.3&q=80&w=400", "thumb": "https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHw1fHx3ZWRkaW5nfGVufDB8fHx8MTY4MzQ3NDc3MQ&ixlib=rb-4.0.3&q=80&w=200", "regular": "https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHw1fHx3ZWRkaW5nfGVufDB8fHx8MTY4MzQ3NDc3MQ&ixlib=rb-4.0.3&q=80&w=1080", "small_s3": "https://s3.us-west-2.amazonaws.com/images.unsplash.com/small/photo-1515934751635-c81c6bc9a2d8"}'),
                'alt' => 'gold-colored bridal ring set on pink rose flower bouquet',
            ],
            [
                'unsplash_id' => 'mW8IZdX7n8E',
                'urls' => json_decode('{"raw": "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxMHx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3", "full": "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?crop=entropy&cs=srgb&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxMHx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=85", "small": "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxMHx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=400", "thumb": "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxMHx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=200", "regular": "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxMHx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=1080", "small_s3": "https://s3.us-west-2.amazonaws.com/images.unsplash.com/small/photo-1511285560929-80b456fea0bc"}'),
                'alt' => 'photo of a man and woman newly wedding holding a balloons',
            ],
            [
                'unsplash_id' => 'K8KiCHh4WU4',
                'urls' => json_decode('{"raw": "https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxM3x8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3", "full": "https://images.unsplash.com/photo-1523438885200-e635ba2c371e?crop=entropy&cs=srgb&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxM3x8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=85", "small": "https://images.unsplash.com/photo-1523438885200-e635ba2c371e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxM3x8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=400", "thumb": "https://images.unsplash.com/photo-1523438885200-e635ba2c371e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxM3x8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=200", "regular": "https://images.unsplash.com/photo-1523438885200-e635ba2c371e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxM3x8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=1080", "small_s3": "https://s3.us-west-2.amazonaws.com/images.unsplash.com/small/photo-1523438885200-e635ba2c371e"}'),
                'alt' => 'gray and beige gazebo near green leafed tree',
            ],
            [
                'unsplash_id' => 'WJc87MVcDaA',
                'urls' => json_decode('{"raw": "https://images.unsplash.com/photo-1546032996-6dfacbacbf3f?ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3", "full": "https://images.unsplash.com/photo-1546032996-6dfacbacbf3f?crop=entropy&cs=srgb&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=85", "small": "https://images.unsplash.com/photo-1546032996-6dfacbacbf3f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=400", "thumb": "https://images.unsplash.com/photo-1546032996-6dfacbacbf3f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=200", "regular": "https://images.unsplash.com/photo-1546032996-6dfacbacbf3f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZ3xlbnwwfHx8fDE2ODM0NzQ3NzE&ixlib=rb-4.0.3&q=80&w=1080", "small_s3": "https://s3.us-west-2.amazonaws.com/images.unsplash.com/small/photo-1546032996-6dfacbacbf3f"}'),
                'alt' => 'smiling newly wed couple about to kiss in green field',
            ],
            [
                'unsplash_id' => 'Ul07QK2AR-0',
                'urls' => json_decode('{"raw": "https://images.unsplash.com/photo-1522413452208-996ff3f3e740?ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZy1ib29iYXxlbnwwfHx8fDE2ODM0NzU1MDg&ixlib=rb-4.0.3", "full": "https://images.unsplash.com/photo-1522413452208-996ff3f3e740?crop=entropy&cs=srgb&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZy1ib29iYXxlbnwwfHx8fDE2ODM0NzU1MDg&ixlib=rb-4.0.3&q=85", "small": "https://images.unsplash.com/photo-1522413452208-996ff3f3e740?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZy1ib29iYXxlbnwwfHx8fDE2ODM0NzU1MDg&ixlib=rb-4.0.3&q=80&w=400", "thumb": "https://images.unsplash.com/photo-1522413452208-996ff3f3e740?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZy1ib29iYXxlbnwwfHx8fDE2ODM0NzU1MDg&ixlib=rb-4.0.3&q=80&w=200", "regular": "https://images.unsplash.com/photo-1522413452208-996ff3f3e740?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=Mnw0MzMwNzN8MHwxfHNlYXJjaHwxNnx8d2VkZGluZy1ib29iYXxlbnwwfHx8fDE2ODM0NzU1MDg&ixlib=rb-4.0.3&q=80&w=1080", "small_s3": "https://s3.us-west-2.amazonaws.com/images.unsplash.com/small/photo-1522413452208-996ff3f3e740"}'),
                'alt' => 'white ceramic dinner plate set on brown wooden table',
            ],
        ]);
    }
}
