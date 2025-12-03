<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SluggableTrait
{
    public static function bootSluggableTrait()
    {
        static::creating(function ($model) {
            $field = $model->slugSource ?? 'title';
            if (empty($model->slug) && !empty($model->$field)) {
                $model->slug = $model->generateUniqueSlug($model->$field);
            }
        });

        static::updating(function ($model) {
            $field = $model->slugSource ?? 'title';
            if ($model->isDirty($field)) {
                $model->slug = $model->generateUniqueSlug($model->$field, $model->id);
            }
        });
    }

    /**
     * Generate a unique slug that only contains a-z, 0-9, and hyphen (-).
     */
    public function generateUniqueSlug($value, $excludeId = null)
    {
        // 1. Convert to lowercase
        $value = strtolower($value);

        // 2. Replace all non-alphanumeric characters with hyphen
        $cleaned = preg_replace('/[^a-z0-9]+/i', '-', $value);

        // 3. Trim multiple hyphens from start/end
        $cleaned = trim($cleaned, '-');

        // 4. Ensure it's URL-friendly
        $slug = Str::slug($cleaned, '-');

        $originalSlug = $slug;
        $counter = 1;

        // 5. Keep adding suffix until unique
        while ($this->slugExists($slug, $excludeId)) {
            $slug = $originalSlug . '-' . $counter++;
        }
        return $slug;
    }

    /**
     * Check if slug already exists in the table.
     */
    protected function slugExists($slug, $excludeId = null)
    {
        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
