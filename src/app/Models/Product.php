<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection<Category> $categories
 * @property Collection<ParameterValue> $parameterValues
 * @method static Product withParameterValuesByCategory(Category $category)
 *
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->using(CategoryProduct::class);
    }

    /**
     * @return HasMany
     */
    public function parameterValues(): HasMany
    {
        return $this->hasMany(ParameterValue::class);
    }

    public function scopeWithParameterValuesByCategory(Builder $query, Category $category)
    {
        $query->with('parameterValues', function (HasMany $builder) use ($category) {
            $builder->whereHas('parameter.categories', function (Builder $builder) use ($category) {
                $builder->where('categories.id', $category->id);
            });
        });
    }
}
