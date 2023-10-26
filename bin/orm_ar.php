<?php

use App\ORM\ActiveRecord\Models\Phone;
use App\ORM\ActiveRecord\Models\User;
use Illuminate\Database\Capsule\Manager;

$container = require_once __DIR__ . '/../src/bootstrap.php';
$container->get(Manager::class);



//$user = new User('Артур','user7@');

$user = User::find(5);
//$phone1 = $user->phones[0];
//$phone1->setPhone('123');
//$phone->delete();
//$phone2 = new Phone('666', $user);

//$user->email = 'u5@';
//$user->delete();
//$user->save();
//$phone1->save();
//$phone2->save();

/**
 * @var User $user
 */
echo $user->name . ' - ' .$user->email . ' - ' . count($user->phones) . ': ' . $user->phones->pluck('phone')->implode(', ') . PHP_EOL;

echo PHP_EOL;


exit;