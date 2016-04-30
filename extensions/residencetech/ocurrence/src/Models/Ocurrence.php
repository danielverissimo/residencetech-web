<?php namespace Residencetech\Ocurrence\Models;

use Cartalyst\Attributes\EntityInterface;
use Firework\Media\Models\MediaTrait;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;
use Carbon\Carbon;

class Ocurrence extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait, MediaTrait;

	protected $table = 'ocurrences';

	protected $guarded = [
		'id',
		'anonym',
		'filter',
		'files',
        'replyData',
	];

    protected $hidden = ['values'];

    protected $appends = ['medias'];

	protected static $entityNamespace = 'residencetech/ocurrence.ocurrence';

    public function replies()
    {
        return $this->hasMany('Residencetech\Ocurrence\Models\Reply');
    }

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
	}

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

	public function getMediasAttribute()
    {
    	return isset($this->attributes['medias']) ? $this->attributes['medias'] : null;
    }
}
