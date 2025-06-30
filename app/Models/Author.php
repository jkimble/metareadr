<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'name',
        'bio',
        'birth_date',
        'death_date',
        'top_work',
        'ratings_average',
        'work_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ratings_average' => 'float',
        'work_count' => 'integer',
    ];

    public static function newAuthor(array $authorData): self
    {
        if (isset($authorData['bio']) && $authorData['bio']) {
            $bio = $authorData['bio']['value'] ?? $authorData['bio'];
        } else {
            $bio = null;
        }

        $key = str_replace('/authors/', '', $authorData['key']);
        $author = self::firstOrNew(['key' => $key]);
        $author->fill([
            'name' => $authorData['name'],
            'bio' => $bio,
            'birth_date' => $authorData['birth_date'],
            'death_date' => $authorData['death_date'],
            'top_work' => $authorData['top_work'],
            'ratings_average' => $authorData['ratings_average'],
            'work_count' => $authorData['work_count'],
        ]);
        $author->save();

        return $author;
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
