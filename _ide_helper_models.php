<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Film
 *
 * @package App\Models
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $people
 * @property-read int|null $people_count
 * @method static \Illuminate\Database\Eloquent\Builder|Film newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Film newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Film query()
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereUpdatedAt($value)
 */
	class Film extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Gender
 *
 * @package App\Models
 * @mixin Eloquent
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $people
 * @property-read int|null $people_count
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereUpdatedAt($value)
 */
	class Gender extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Homeworld
 *
 * @package App\Models
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $people
 * @property-read int|null $people_count
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld query()
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Homeworld whereUpdatedAt($value)
 */
	class Homeworld extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Person
 *
 * @package App\Models
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property string $height
 * @property string $mass
 * @property string $hair_color
 * @property string $birth_year
 * @property int $gender_id
 * @property int $homeworld_id
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Film[] $films
 * @property-read int|null $films_count
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\Homeworld $homeworld
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereHairColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereHomeworldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUrl($value)
 */
	class Person extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

