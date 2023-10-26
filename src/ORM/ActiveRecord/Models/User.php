<?php

namespace App\ORM\ActiveRecord\Models;

use App\ORM\ActiveRecord\NormalObjectBehavior;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use NormalObjectBehavior;

    const DEFAULT_STATUS = 0;
    protected $table = "users";

    private ?int $id = null;
    private int $status = self::DEFAULT_STATUS;

    public $timestamps = false;

    public function __construct(private string $name, private string $email)
    {
        parent::__construct();
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function reName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function changeEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatusActive(): void
    {
        $this->status = 1;
    }

    public function setStatusVip(): void
    {
        $this->status = 2;
    }


    public static function getAll()
    {
//        $users = User::all();
        $users = User::query()->where('status', '>=', 0)->get();

        return $users;
    }

    public static function getActiveUsers()
    {
        $users = User::query()->where('status', 1)->get();
        return $users;
    }

}
