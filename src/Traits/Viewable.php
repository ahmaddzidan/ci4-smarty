<?php

namespace Asanusi007\Smarty\Traits;

trait Viewable
{
    protected function parse(string $template, array $data = [], ?bool $return = false, ?bool $caching = false, ?string $cacheId = null)
    {
        $parser = \Config\Services::SmartyEngine();

        if (ENVIRONMENT === 'development') {
            $caching = false;
        }

        return $parser->parse($template, $data, $return, $caching, $cacheId);
    }

    protected function isCached(string $template, string $cacheId)
    {
        $parser = \Config\Services::SmartyEngine();

        $parser->enableCaching();

        return $parser->isCached($template . '.' . $parser->templateExt, $cacheId);
    }
}
