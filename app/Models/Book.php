<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'title',
        'author_names',
        'author_key',
        'first_publish_year',
        'subjects',
        'isbn',
        'number_of_pages',
        'cover_i',
        'cover_edition_key',
        'ratings_count',
        'number_of_pages_median',
        'first_sentence',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'author_names' => 'array',
        'subjects' => 'array',
        'isbn' => 'array',
    ];

    public function Users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function Authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
