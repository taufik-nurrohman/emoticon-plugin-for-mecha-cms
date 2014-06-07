/**
 * Table Row Order Manager
 */

(function($) {

    var $tbody = $('.table-emoticon-defines tbody');

    $tbody.on("click", 'td > a', function() {
        var $tr = $(this).closest('tr');
        if (this.hash.replace('#', "") == 'move-up') {
            if ($tr.prev().is('tr')) {
                $tr.insertBefore($tr.prev());
            }
        } else {
            if ($tr.next().is('tr')) {
                $tr.insertAfter($tr.next());
            }
        }
        return false;
    });

})(Zepto);