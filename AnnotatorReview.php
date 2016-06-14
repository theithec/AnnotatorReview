<?php
# Alert the user that this is not a valid access point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
	echo <<<EOT
To install this extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/AnnotatorReview/AnnotatorReview.php" );
EOT;
	exit( 1 );
}


global $wgExtensionCredits, $wgAutoloadClasses, $wgExtensionMessagesFiles, 
        $wgSpecialPages, $wgSpecialPageGroups, $wgAnnotatorReviewDisplayInToolbox,
        $wgHooks;

$wgExtensionCredits['specialpage'][] = array(
    'path' => __FILE__,
    'name' => 'AnnotatorReview',
    'author' => 'Gabriel Birke <gb@birke-software.de>', 
    'url' => '', 
    'descriptionmsg' => 'annotatorreview-desc',
    'version'  => 1.0,
);


$wgAutoloadClasses[ 'Birke\Mediawiki\AnnotatorReview\SpecialAnnotatorReview' ] = __DIR__ . '/SpecialAnnotatorReview.php'; 
$wgAutoloadClasses[ 'Birke\Mediawiki\AnnotatorReview\AnnotatorPager' ] = __DIR__ . '/AnnotatorPager.php'; 
$wgAutoloadClasses[ 'Birke\Mediawiki\AnnotatorReview\AnnotatorAnnotatedPages' ] = __DIR__ . '/AnnotatorAnnotatedPages.php'; 
$wgExtensionMessagesFiles[ 'AnnotatorReview' ] = __DIR__ . '/AnnotatorReview.i18n.php'; # Location of a messages file (Tell MediaWiki to load this file)
$wgExtensionMessagesFiles[ 'AnnotatorReviewAlias' ] = __DIR__ . '/AnnotatorReview.alias.php'; # Location of an aliases file (Tell MediaWiki to load this file)
$wgSpecialPages[ 'AnnotatorReview' ] = 'Birke\Mediawiki\AnnotatorReview\SpecialAnnotatorReview'; # Tell MediaWiki about the new special page and its class name

$wgSpecialPageGroups[ 'AnnotatorReview' ] = 'pagetools';

$wgAnnotatorReviewDisplayInToolbox = true;

$wgHooks['BaseTemplateToolbox'][] = function( $sk, &$toolbox) {
    global $wgAnnotatorReviewDisplayInToolbox;
    if (!$wgAnnotatorReviewDisplayInToolbox || !$sk->get('isarticle', false)) {
        return;
    }
    $title = SpecialPage::getTitleFor("AnnotatorReview", $sk->get('title'));
    $toolbox['annotator-review'] = array(
        'text' => wfMessage('annotatorreview-toolbox'),
        'href' => $title->getLinkURL(),
        'id'   => 't-annotator-review'
    );
};

