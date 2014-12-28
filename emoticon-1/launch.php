<?php

// Load the configuration data
$emoticon_config = File::open(PLUGIN . DS . basename(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize();

// Add the stylesheet
Weapon::add('shell_after', function() {
    echo Asset::stylesheet('cabinet/plugins/' . basename(__DIR__) . '/shell/icons.css');
}, 11);

// Build the parser
function simple_emoticon_parser($content) {
    global $emoticon_config;
    foreach($emoticon_config['defines'] as $icon => $patterns) {
        if( ! empty($patterns)) {
            $patterns = preg_replace('/ +/', '|', preg_quote($patterns, '/'));
            $content = preg_replace('/(^|\n|\r|\s|>)(' . $patterns . ')/', '$1<i class="se-i se-i-' . $icon . '"></i>', $content);
        }
    }
    return $content;
}

// Register the filters
if(isset($emoticon_config['scopes']) && is_array($emoticon_config['scopes'])) {
    foreach($emoticon_config['scopes'] as $scope) {
        Filter::add($scope, 'simple_emoticon_parser');
    }
}


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . basename(__DIR__) . '/update', function() use($config, $speak) {
    if( ! Guardian::happy()) {
        Shield::abort();
    }
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        unset($request['token']); // Remove token from request array
        File::serialize($request)->saveTo(PLUGIN . DS . basename(__DIR__) . DS . 'states' . DS . 'config.txt');
        Notify::success(Config::speak('notify_success_updated', array($speak->plugin)));
        Guardian::kick(dirname($config->url_current));
    }
});