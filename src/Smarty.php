<?php

namespace Asanusi007\Smarty;

use Asanusi007\Smarty\Config\Smarty as SmartyConfig;
use Smarty\Smarty as Core;

/**
 * CI Smarty
 *
 * Smarty templating for Codeigniter
 *
 * @copyright Copyright (c) 2024, Ahmad Sanusi
 * @see      https://github.com/asanusi007/ci-smarty
 * @license   MIT
 * @version   1.0
 */
class Smarty extends Core
{
    public $templateExt          = 'tpl';
    protected $templateLocations = [];
    protected $currentPath;
    protected $config;

    public function __construct()
    {
        parent::__construct();

        if ($this->config !== $this->config instanceof SmartyConfig) {
            $this->config = new SmartyConfig();
        }

        // // Turn on/off debug
        $this->debugging = $this->config->smarty_debug;

        // Set some pretty standard Smarty directories
        $this->setCompileDir($this->config->compile_directory);
        $this->setCacheDir($this->config->cache_directory);
        $this->setConfigDir($this->config->config_directory);
        $this->setCacheLifetime($this->config->cache_lifetime);

        // // Default template extension
        $this->templateExt = $this->config->template_ext;

        // // How long to cache templates for
        $this->cache_lifetime = $this->config->cache_lifetime;

        // // Disable Smarty security policy
        // $this->disableSecurity();

        // Set the error reporting level
        $this->error_reporting = $this->config->template_error_reporting;

        $this->setTemplateLocation();

        $this->registerSmartyPlugin();
    }

    /**
     * Parse
     *
     * Parses a template using Smarty 3 engine
     *
     * @param            $theme
     * @param mixed|null $cacheId
     *
     * @return string
     */
    public function parse($template, $data = [], $return = false, $caching = false, $cacheId = null)
    {
        // If we don't want caching, disable it
        if ($caching === true && ENVIRONMENT !== 'development') {
            $this->setCaching(Core::CACHING_LIFETIME_CURRENT);
        } else {
            $this->setCaching(Core::CACHING_OFF);
        }

        // If no file extension dot has been found default to defined extension for view extensions
        if (! stripos($template, '.')) {
            $template = $template . '.' . $this->templateExt;
        }

        // Get the location of our view, where the hell is it?
        // But only if we're not accessing a smart resource
        if (! stripos($template, ':')) {
            $template = $this->findView($template);
        }

        // If we have variables to assign, lets assign them
        if (! empty($data)) {
            foreach ($data as $key => $val) {
                $this->assign($key, $val);
            }
        }

        // Load our template into our string for judgement
        $templateString = $this->fetch($template, $cacheId);

        // If we're returning the templates contents, we're displaying the template
        if ($return === false) {
            // parent::display($template);
            $view = \Config\Services::renderer();
            $view->renderString($templateString);
        }

        // We're returning the contents, fo' shizzle
        return $templateString;
    }

    /**
     * Find View
     *
     * Searches through module and view folders looking for your view, sir.
     *
     * @return string The path and file found
     */
    protected function findView($file)
    {
        // We have no path by default
        $path = null;

        // Get template locations
        $locations = $this->templateLocations;

        // Iterate over our saved locations and find the file
        foreach ($locations as $location) {
            if (file_exists($location . $file)) {
                // Store the file to load
                $path = $location . $file;

                $this->currentPath = $location;

                // Stop the loop, we found our file
                break;
            }
        }

        // Return the path
        return $path;
    }

    /**
     * Set Template location
     *
     * Searches through module and view folders looking for your view, sir.
     *
     * @param array|null $location
     *
     * @return void The path and file found
     */
    public function setTemplateLocation($location = null)
    {
        $this->templateLocations = array_merge($this->templateLocations, $this->config->template_directory);

        $this->addPaths();
    }

    /**
     * Add Paths
     *
     * Traverses all added template locations and adds them
     * to Smarty so we can extend and include view files
     * correctly from a slew of different locations including
     * modules if we support them.
     */
    protected function addPaths()
    {
        // Iterate over our saved locations and find the file
        foreach ($this->templateLocations as $location) {
            $this->addTemplateDir($location);
        }
    }

    /**
     * String Parse
     *
     * Parses a string using Smarty
     *
     * @param string $template
     * @param array  $data
     * @param bool   $return
     * @param mixed  $is_include
     */
    public function stringParse($template, $data = [], $return = false, $is_include = false)
    {
        return $this->fetch('string:' . $template, $data);
    }

    /**
     * Parse String
     *
     * Parses a string using Smarty. Never understood why there
     * was two identical functions in Codeigniter that did the same.
     *
     * @param string $template
     * @param array  $data
     * @param bool   $return
     * @param mixed  $is_include
     */
    public function parseString($template, $data = [], $return = false, $is_include = false)
    {
        return $this->stringParse($template, $data, $return, $is_include);
    }

    /**
     * Register Modifier
     *
     * Register smarty modifier
     *
     * @return void
     */
    public function registerSmartyPlugin()
    {
        $modifiers = $this->config->smarty_modifiers;

        if (is_array($modifiers) && ! empty($modifiers)) {
            foreach ($modifiers as $modifier) {
                $this->registerPlugin('modifier', $modifier, $modifier);
            }
        }
    }

    /**
     * Print Smarty Version
     *
     * Pass smarty version to be accessed in our app
     *
     * @return string
     */
    public function version()
    {
        return Core::SMARTY_VERSION;
    }

    /**
     * Enable Smarty Smart Caching
     *
     * Override global cache config
     *
     * @return mixed
     */
    public function enableCaching()
    {
        return $this->setCaching(Core::CACHING_LIFETIME_CURRENT);
    }
}
