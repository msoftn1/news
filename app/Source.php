<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Источники.
 */
class Source extends Model
{
    use QueryCacheable;

    protected $table = 'sources';
}
