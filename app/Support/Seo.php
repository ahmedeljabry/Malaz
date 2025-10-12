<?php

namespace App\Support;

class Seo
{
    /**
     * Build SEO array with sane defaults and overrides.
     */
    public static function for(string $pageKey = 'page', array $overrides = []): array
    {
        $config = config('seo');

        $title = $overrides['title'] ?? $config['default']['title'];
        $site = $config['site_name'] ?? null;
        if ($site && $title && !str_contains($title, $site)) {
            $title = trim($title.' '.($config['title_separator'] ?? '|').' '.$site);
        }

        $canonical = $overrides['canonical'] ?? url()->current();
        $description = trim((string)($overrides['description'] ?? $config['default']['description']));
        $image = $overrides['image'] ?? $config['default']['image'];
        $locale = $overrides['locale'] ?? app()->getLocale();

        // OpenGraph defaults
        $og = array_filter([
            'title' => $overrides['og']['title'] ?? $title,
            'description' => $overrides['og']['description'] ?? $description,
            'type' => $overrides['og']['type'] ?? 'website',
            'url' => $overrides['og']['url'] ?? $canonical,
            'image' => $overrides['og']['image'] ?? $image,
            'locale' => $overrides['og']['locale'] ?? $locale,
            'site_name' => $site,
        ]);

        // Twitter defaults
        $twitter = array_filter(array_merge(
            $config['twitter'] ?? [],
            $overrides['twitter'] ?? [],
            [
                'title' => $overrides['twitter']['title'] ?? $title,
                'description' => $overrides['twitter']['description'] ?? $description,
                'image' => $overrides['twitter']['image'] ?? $image,
            ]
        ));

        // JSON-LD Schema (accept overrides, allow array(s))
        $schema = $overrides['schema'] ?? [];
        if (is_array($schema) && isset($schema['@context']) === false) {
            $schema = [$schema];
        }

        return array_filter([
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'image' => $image,
            'og' => $og,
            'twitter' => $twitter,
            'schema' => $schema,
            'page' => $pageKey,
        ]);
    }
}

