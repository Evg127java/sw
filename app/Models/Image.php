<?php

namespace App\Models;

use Arr;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\File;
use Storage;

/**
 * Class Image
 * @package App\Models
 * @mixin Eloquent
 */
class Image extends Model
{
    protected $fillable = ['path', 'person_id'];
    use HasFactory;

    /**
     * Each image is related to the only person(reverse relation one to many)
     * @return BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Makes a new Image model's instance with specified data
     * @param string $imagePath image's model property value
     * @param int $personId
     * @return Image|Model
     */
    public static function getNewImageInstance(string $imagePath, int $personId)
    {
        return self::create([
            'path' => $imagePath,
            'person_id' => $personId,
        ]);
    }

    /**
     * Saves the passed image in Storage in the directory by person's id
     * @param $image
     * @param int $personId
     * @return false|string
     */
    public static function saveImageInStorage($image, int $personId)
    {
        return Storage::putFile('images/' . $personId, new File($image));
    }

    /**
     * Saves the passed images array in the specified directory
     * @param array $images images array to save
     * @param int $personId directory for saving
     * @return array         saved images array
     */
    public static function saveImages(array $images, int $personId)
    {
        $storedImagesInstances = [];
        foreach ($images as $image) {
            if ($image->isValid()) {

                /* Save the image in storage and get the path to it */
                $path = self::saveImageInStorage($image, $personId);

                /* Form the stored images' instances array */
                $imageInstance = self::getNewImageInstance($path, $personId);
                $storedImagesInstances[] = $imageInstance;
            }
        }
        return $storedImagesInstances;
    }

    /**
     * Deletes specified images
     * Deletes images instances in DB and images themselves in storage
     * @param array $imageIdArray images ids
     */
    public static function deleteImages(array $imageIdArray)
    {
        /* Get paths of images in storage to delete */
        $paths = Image::findMany($imageIdArray)->pluck('path');

        /* Delete images in storage */
        Storage::delete(Arr::flatten($paths));

        /* Delete images model instances in DB */
        Image::destroy($imageIdArray);
    }
}
