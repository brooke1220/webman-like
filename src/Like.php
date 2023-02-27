<?php

namespace Brooke1220\WebmanLike;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Brooke1220\WebmanLike\Events\Liked;
use Brooke1220\WebmanLike\Events\Unliked;

class Like extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => Liked::class,
        'deleted' => Unliked::class,
    ];


    public function __construct(array $attributes = [])
    {
        $this->connection = config('plugin.brooke1220.webman-like.app.database_connection');
        $this->table = config('plugin.brooke1220.webman-like.app.likes_table');

        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($like) {
            if (config('plugin.brooke1220.webman-like.app.uuids')) {
                $like->{$like->getKeyName()} = $like->{$like->getKeyName()} ?: (string) Str::orderedUuid();
            }
        });
    }

    public function likeable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('plugin.brooke1220.webman-like.app.user_model'), config('plugin.brooke1220.webman-like.app.user_foreign_key'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function liker()
    {
        return $this->user();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithType(Builder $query, string $type)
    {
        return $query->where('likeable_type', \support\Container::get($type)->getMorphClass());
    }
}