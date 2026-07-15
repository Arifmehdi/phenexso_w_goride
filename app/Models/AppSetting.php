<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Simple key/value store for platform-level settings the admin can change
 * at runtime (maintenance mode, registration toggle, commission rate).
 * Values are stored as strings; callers cast.
 */
class AppSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /** Read a setting; never throws (safe before the table is migrated). */
    public static function getValue(string $key, $default = null)
    {
        try {
            $value = static::where('key', $key)->value('value');
            return $value ?? $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    public static function setValue(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => (string) $value]);
    }
}
