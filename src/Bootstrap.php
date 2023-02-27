<?php

namespace Brooke1220\WebmanLike;

use Brooke1220\WebmanLike\Events\Liked;
use Brooke1220\WebmanLike\Events\Unliked;
use Illuminate\Support\Facades\Event;

class Bootstrap implements \Webman\Bootstrap
{
    public static function start($worker)
    {
        Like::getEventDispatcher()->listen(
            Liked::class,
            function(Liked $event){
                \Webman\Event\Event::emit(Liked::class, $event);
            }
        );

        Like::getEventDispatcher()->listen(
            Unliked::class,
            function(Unliked $event){
                \Webman\Event\Event::emit(Unliked::class, $event);
            }
        );
    }
}