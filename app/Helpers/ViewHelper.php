<?php
namespace App\Helpers;

/**
 * Class ViewHelper
 * Provides functionality to create some view HTM elements.
 *
 * @package App\Helpers
 * @author  GeorgeShazkho<shazkho@gmail.com>
 * @version 0.2
 */
class ViewHelper
{

    /**
     * Creates a breadcrumb as to be used in Bootstrap.
     *
     * @param   array   $breadcrumbItems    Breadcrumb definition (with links).
     * @return  string  An HTML string defining the breadcrumb.
     *
     * @author  GeorgeShazkho<shazkho@gmail.com>
     * @version 0.2
     */
    public static function makeBreadcrumb($breadcrumbItems=[])
    {
        $breadcrumbLinkFormat = '<li class="breadcrumb-item"><a href="%s">%s</a></li>';
        $breadcrumbActiveFormat = '<li class="breadcrumb-item active" aria-current="page">%s</li>';
        $breadcrumb = '<li class="breadcrumb-item"><a href="' . route('tareas.index') . '">Inicio</a></li>';

        foreach ($breadcrumbItems as $item => $link) {
            if ($link == null) {
                $breadcrumb .= sprintf($breadcrumbActiveFormat, $item);
            } else {
                $breadcrumb .= sprintf($breadcrumbLinkFormat, $link, $item);
            }
        }
        return $breadcrumb;
    }

}