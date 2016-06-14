<?php

namespace Birke\Mediawiki\AnnotatorReview;

class SpecialAnnotatorReview extends \SpecialPage {
	function __construct() {
		parent::__construct( 'AnnotatorReview' );
	}
 
	function execute( $par ) {
		$request = $this->getRequest();
                /** @var \OutputPage **/
		$output = $this->getOutput();
		$this->setHeaders();
                
                if (!$par) {
                    $pager = new AnnotatorAnnotatedPages($this->getContext());
                    $output->setPageTitle($this->msg('annotatorreview-all-pages'));
                }
                else {
                    $title = \Title::newFromText($par);
                    $pager = new AnnotatorPager($this->getContext(), $title);
                    $output->setPageTitle($this->msg('annotatorreview-page-title', htmlspecialchars($title->getText())));
                }
		
                $output->addHTML($pager->getBody());
                $output->addHTML($pager->getNavigationBar());
                
	}
}
