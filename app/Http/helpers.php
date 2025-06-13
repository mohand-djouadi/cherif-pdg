<?php

//Add customized title

use Illuminate\Support\Facades\Route;

if (!function_exists('page_title')) {
    function page_title($title)
    {
        $base_title = config('app.name');
        if ($title === '')
            return $base_title;
        else return $title . ' | ' . $base_title;
    }
}

// Set menu to active
if (!function_exists('set_active_route')) {
    function set_active_route($route)
    {
        return Route::is($route) ? 'active' : '';
    }
}

// Set menu to active
if (!function_exists('set_active_route_dropdown')) {
    function set_active_route_dropdown($route)
    {
        return Route::is($route) ? 'menu-is-opening menu-open' : '';
    }
}


// Set menu to active
if (!function_exists('set_active_tab')) {
    function set_active_tab($name, $tab)
    {
        return $name == $tab ? ' active show' : '';
    }
}
// Get semestre by date
function getSemesterByDate($date)
{
    // Convert the date string to a DateTime object
    $dateTime = new DateTime($date);

    // Extract the month from the DateTime object
    $month = $dateTime->format('n');

    // Determine the semester based on the month
    if ($month >= 1 && $month <= 6) {
        $semester = '1';
    } elseif ($month >= 7 && $month <= 12) {
        $semester = '2';
    } else {
        $semester = 'Invalid';
    }


    return $semester;
}


// Exemple de contrôleur
if (!function_exists('truncateText')) {
    /**
     * Truncate the text to a specific length and add ellipsis if necessary.
     *
     * @param string $text
     * @param int $maxLength
     * @return string
     */
    function truncateText($text, $maxLength = 100)
    {
        // Vérifier la longueur du texte
        if (strlen($text) <= $maxLength) {
            return $text; // Retourner tout le texte s'il a 100 caractères ou moins
        }

        // Tronquer le texte et ajouter des points de suspension
        return substr($text, 0, $maxLength) . '...';
    }
}
