<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait HasLocalization
{
    /**
     * Get a localized attribute.
     *
     * @param string $attribute
     * @return mixed
     */
    public function getLocalized($attribute)
    {
        $locale = App::getLocale();
        $localizedAttribute = $attribute . '_' . $locale;

        if ($locale !== 'en' && isset($this->attributes[$localizedAttribute]) && !empty($this->attributes[$localizedAttribute])) {
            return $this->attributes[$localizedAttribute];
        }

        // Fallback to English/Default
        $defaultAttribute = $attribute . '_en';
        if (isset($this->attributes[$defaultAttribute])) {
            return $this->attributes[$defaultAttribute];
        }

        // Try the base attribute name
        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }

        return null;
    }

    /**
     * Dynamically handle localized calls.
     * 
     * Usage: $model->localized_title
     */
    public function __get($key)
    {
        if (strpos($key, 'localized_') === 0) {
            $attribute = str_replace('localized_', '', $key);
            return $this->getLocalized($attribute);
        }

        return parent::__get($key);
    }
}
