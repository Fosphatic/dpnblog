<?php

namespace Dpn\Blog\Event;

use Pagekit\Application as App;
use Dpn\Blog\UrlResolver;
use Dpn\Blog\UrlResolverCategory;
use Pagekit\Event\EventSubscriberInterface;

class RouteListener implements EventSubscriberInterface
{
    /**
     * Adds cache breaker to router.
     */
    public function onAppRequest()
    {
        App::router()->setOption('dpnblog.permalink', UrlResolver::getPermalink());
        App::router()->setOption('dpnblog.permalink', UrlResolverCategory::getPermalink());
    }

    /**
     * Registers permalink route alias.
     */
    public function onConfigureRoute($event, $route)
    {
        if ($route->getName() == '@dpnblog/id' && UrlResolver::getPermalink()) {
            App::routes()->alias(dirname($route->getPath()).'/'.ltrim(UrlResolver::getPermalink(), '/'), '@dpnblog/id', ['_resolver' => 'Dpn\Blog\UrlResolver']);
        }

        if ($route->getName() == '@dpnblog/cat' && UrlResolverCategory::getPermalink()) {
            App::routes()->alias(dirname($route->getPath()).'/'.ltrim(UrlResolverCategory::getPermalink(), '/'), '@dpnblog/cat', ['_resolver' => 'Dpn\Blog\UrlResolverCategory']);
        }
    }

    /**
     * Clears resolver cache.
     */
    public function clearCache()
    {
        App::cache()->delete(UrlResolver::CACHE_KEY);
        App::cache()->delete(UrlResolverCategory::CACHE_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'request'                 => ['onAppRequest', 130],
            'route.configure'         => 'onConfigureRoute',
            'model.post.saved'        => 'clearCache',
            'model.post.deleted'      => 'clearCache'
        ];
    }
}
