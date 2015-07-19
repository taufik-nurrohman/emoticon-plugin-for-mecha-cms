<?php

// Load the configuration data
$emoticon_config = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize();

// Add the emoticon stylesheet
Weapon::add('shell_after', function() {
    echo Asset::stylesheet('cabinet/plugins/' . File::B(__DIR__) . '/assets/shell/icons.css');
}, 11);

// Build the emoticon parser
function simple_emoticon_parser($content) {
    global $emoticon_config;
    foreach($emoticon_config['defines'] as $icon => $pattern) {
        if(trim($pattern) !== "") {
            $pattern = preg_replace('# +#', '|', preg_quote($pattern, '#'));
            $content = preg_replace('#(^|[\s\>])(' . $pattern . ')#', '$1<span class="se">&#x' . $icon . ';</span>', $content);
        }
    }
    return $content;
}

// Remove broken emoticons in recent comment summary
Filter::add('widget:recent.comment', function($content) {
    return preg_replace('#&\#x[a-f0-9]+;#', ' ', $content);
});

// Register the filters
if(isset($emoticon_config['scopes']) && is_array($emoticon_config['scopes'])) {
    foreach($emoticon_config['scopes'] as $scope) {
        Filter::add($scope, 'simple_emoticon_parser');
    }
}