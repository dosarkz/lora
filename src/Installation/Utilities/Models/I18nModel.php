<?php
namespace Dosarkz\Lora\Installation\Utilities\Models;

use Illuminate\Database\Eloquent\Model;

use App;

/**
 * App\I18nModel
 *
 */
class I18nModel extends Model {
    protected $visibleI18n = [];

    public function toArray()
    {
        $array = parent::toArray();

        foreach ($this->visibleI18n as $field) {
            $array[$field] = $this->{$field};
        }

        return $array;
    }

    /**
     * Get an attribute from the model.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $inAttributes = array_key_exists($key, $this->attributes);

        // If the key references an attribute, we can just go ahead and return the
        // plain attribute value from the model. This allows every attribute to
        // be dynamically accessed through the _get method without accessors.
        if ($inAttributes || $this->hasGetMutator($key))
        {
            return $this->getAttributeValue($key);
        }
        else
        {
            $i18nKey = $key . '_' . App::getLocale();
            $enKey = $key . '_ru';

            $inAttributes = array_key_exists($i18nKey, $this->attributes);

            if ($inAttributes || $this->hasGetMutator($i18nKey))
            {
                $value = $this->getAttributeValue($i18nKey);

                return $value ? $value : $this->getAttributeValue($enKey);
            }
        }

        // If the key already exists in the relationships array, it just means the
        // relationship has already been loaded, so we'll just return it out of
        // here because there is no need to query within the relations twice.
        if (array_key_exists($key, $this->relations))
        {
            return $this->relations[$key];
        }

        // If the "attribute" exists as a method on the model, we will just assume
        // it is a relationship and will load and return results from the query
        // and hydrate the relationship's value on the "relationships" array.
        if (method_exists($this, $key))
        {
            return $this->getRelationshipFromMethod($key);
        }
    }
}
