<?php namespace Residencetech\Admin\Models;

use Carbon\Carbon;
use Config;

trait DateTrait
{

	public function attributesToArray()
	{

		$attributes = $this->getArrayableAttributes();

		// If an attribute is a date, we will cast it to a string after converting it
		// to a DateTime / Carbon instance. This is so we will get some consistent
		// formatting while accessing attributes vs. arraying / JSONing a model.
		foreach ($this->getDates() as $key)
		{
			if ( ! isset($attributes[$key])) continue;

			$t = $this->asDateTime($attributes[$key]);

			if ($t->timestamp <= 0) {
				continue;
			}

			$t->timezone = Config::get('platform.site.timezone');

			$attributes[$key] = (string) $this->asDateTime($t->toDateTimeString());
		}

		// We want to spin through all the mutated attributes for this model and call
		// the mutator for the attribute. We cache off every mutated attributes so
		// we don't have to constantly check on attributes that actually change.
		foreach ($this->getMutatedAttributes() as $key)
		{
			if ( ! array_key_exists($key, $attributes)) continue;

			$attributes[$key] = $this->mutateAttributeForArray(
				$key, $attributes[$key]
			);
		}

		return $attributes;
	}

	protected function getAttributeValue($key)
	{

		$value = $this->getAttributeFromArray($key);

		// If the attribute has a get mutator, we will call that then return what
		// it returns as the value, which is useful for transforming values on
		// retrieval from the model to a form that is more useful for usage.
		if ($this->hasGetMutator($key))
		{

			return $this->mutateAttribute($key, $value);
		}

		// If the attribute is listed as a date, we will convert it to a DateTime
		// instance on retrieval, which makes it quite convenient to work with
		// date fields without having to create a mutator for each property.
		elseif (in_array($key, $this->getDates()))
		{
			if ($value)
			{
				$t = $this->asDateTime($value);
				$t->timezone = Config::get('platform.site.timezone');

				return $this->asDateTime($t->toDateTimeString());
			}
		}

		return $value;
	}

}
