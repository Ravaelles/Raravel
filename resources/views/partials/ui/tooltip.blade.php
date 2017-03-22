<?php
/**
 * This script allows to display bootstrap tooltip with some enhanced functionality like 
 * 'align' => justify|left
 * 
 * Example usage:
 * @include('partials/ui/tooltip', [
 *     'message' => 'Hello, this is your tooltip'
 * ])
 */
if (!empty($align)) {
    if ($align === 'justify') {
        $message = "<div style='text-align: justify'>$message</div>";
    } else if ($align === 'left') {
        $message = "<div style='text-align: left'>$message</div>";
    }
}
?> data-toggle="tooltip" data-html="true" data-placement="{!! $position or 'bottom' !!}" title="{!! $message or '' !!}"