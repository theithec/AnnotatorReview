<?php
/**
 * Internationalisation for annotatorreview
 *
 * @file
 * @ingroup Extensions
 */
$messages = array();
 
/** English
 * @author Gabriel Birke
 */
$messages[ 'en' ] = array(
    'annotatorreview' => "Annotator Review", // Important! This is the string that appears on Special:SpecialPages
    'annotatorreview-desc' => "Display special page for annotations",
    'annotatorreview-set-on' => "Annotated on '$1'",
    'annotatorreview-toolbox' => "List Annotations",
    'annotatorreview-page-title' => "Annotations for page '$1'",
    'annotatorreview-all-pages'  => "Pages with recent annotations",
);

/** German
 * @author  Gabriel Birke
 */
$messages[ 'de' ] = array(
    'annotatorreview' => "Übersicht Anmerkungen", 
    'annotatorreview-desc' => "Zeige eine Übersicht der Anmerkungen für eine Seite",
    'annotatorreview-set-on' => "Anmerkung auf '$1'",
    'annotatorreview-toolbox' => "Liste der Anmerkungen",
    'annotatorreview-page-title' => "Anmerkungen für Seite '$1'",
    'annotatorreview-all-pages'  => "Seiten, auf denen Anmerkungen geschrieben wurden",
);
 
/** Message documentation
 * @author Gabriel Birke
 */
$messages[ 'qqq' ] = array(
    'annotatorreview' => "The name of the extension's entry in Special:SpecialPages",
    'annotatorreview-desc' => "{{desc}}",
    'annotatorreview-set-on' => "Intruductory text for title attribute aof comment. $1 is the quote that the annotation belongs to",
    'annotatorreview-toolbox' => "Text of link to special page in toolbox",
    'annotatorreview-page-title' => "Page title for annotations list of a single page. $1 is the original page title ",
    'annotatorreview-all-pages'  => "Page title for the list of all pages with recent annotations",
);
