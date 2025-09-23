<?php

if (!function_exists('is_active')) {
    /**
     * Checks if a navigation link is active based on the current URL segment.
     *
     * @param string $segment The URL segment to check (e.g., 'courses', 'students').
     * @return string Returns 'active' if it's the current page, otherwise empty.
     */
    function is_active(string $segment): string
    {
        $uri = service('uri');
        if ($uri->getSegment(2) === $segment) {
            return 'active';
        }
        return '';
    }
}