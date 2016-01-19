<?php

// Load the configuration data
$emoticon_config = File::open(__DIR__ . DS . 'states' . DS . 'config.txt')->unserialize();

// Build the emoticon parser
function do_emoticon_font($content) {
    global $emoticon_config;
    foreach($emoticon_config['defines'] as $icon => $pattern) {
        if(trim($pattern) !== "") {
            $pattern = preg_replace('# +#', '|', preg_quote($pattern, '#'));
            $content = preg_replace('#(^|[>\s])(' . $pattern . ')#', '$1<i class="se" data-icon="&#x' . $icon . ';"></i>', $content);
        }
    }
    return $content;
}

// Apply `do_emoticon_font` filter
if(isset($emoticon_config['scopes']) && is_array($emoticon_config['scopes'])) {
    Filter::add($emoticon_config['scopes'], 'do_emoticon_font');
}

// Apply skin to the page
Weapon::add('shell_after', function() {
    echo Asset::stylesheet(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'icons.css');
}, 11);