<?php

namespace Brooke1220\WebmanLike\Traits;

use Illuminate\Database\Eloquent\Model;

trait Likeable
{
    public function isLikedBy(Model $user): bool
    {
        if (\is_a($user, config('plugin.brooke1220.webman-like.app.user_model'))) {
            if ($this->relationLoaded('likers')) {
                return $this->likers->contains($user);
            }

            return $this->likers()->where(config('plugin.brooke1220.webman-like.app.user_foreign_key'), $user->getKey())->exists();
        }

        return false;
    }

    /**
     * Return followers.
     */
    public function likers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            config('plugin.brooke1220.webman-like.app.user_model'),
            config('plugin.brooke1220.webman-like.app.likes_table'),
            'likeable_id',
            config('plugin.brooke1220.webman-like.app.user_foreign_key')
        )
            ->where('likeable_type', $this->getMorphClass());
    }
}