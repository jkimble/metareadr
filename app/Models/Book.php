<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
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

    public static function newBook(array $bookData): self
    {
        $key = str_replace('/works/', '', $bookData['key']);
        $book = Book::firstOrNew(['key' => $key]);
        $book->fill([
            'title' => $bookData['title'],
            'author_name' => $bookData['author_name'][0],
            'author_key' => $bookData['author_key'][0],
            'first_publish_year' => $bookData['first_publish_year'],
            'subjects' => $bookData['subject'][0],
            'isbn' => $bookData['isbn'][0],
            'cover_i' => $bookData['cover_i'],
            'cover_edition_key' => $bookData['cover_edition_key'],
            'ratings_count' => $bookData['ratings_count'],
            'number_of_pages_median' => $bookData['number_of_pages_median'],
            'first_sentence' => $bookData['first_sentence'][0],
        ]);
        $book->save();

        return $book;
    }

    public function Users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_users')->withTimestamps();
    }

    public function Authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
