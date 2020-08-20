<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Новости.
 */
class News extends Model
{
    use QueryCacheable;

    protected $table = 'news';

    /**
     * Получить ID картинки.
     *
     * @return string|null
     */
    public function getImageId(): ?string
    {
        $data = explode('/', $this->image);
        $id = explode('.', $data[count($data) - 1]);

        if (count($id) < 2) {
            return null;
        }

        return $id[0] . '_' . $id[1];
    }

    /**
     * Получить источник.
     *
     * @return Source
     */
    public function source(): Source
    {
        return $this->belongsTo('App\Source', 'source_id')->first();
    }
}
