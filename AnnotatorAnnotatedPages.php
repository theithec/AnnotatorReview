<?php

namespace Birke\Mediawiki\AnnotatorReview;

/**
 * This class displays the pages that have annotations
 */
class AnnotatorAnnotatedPages extends \ReverseChronologicalPager {
        
    public function formatRow($row) {
        
        $s = "";
        if ($this->mFirstShown == $row->annotation_id) {
            $s .= "<ul class='annotator-review-pages'>\n";
        }
        
        $title = \Title::newFromRow($row);
        $s .= "<li>";
        $s .= \Linker::linkKnown(\SpecialPage::getSafeTitleFor('AnnotatorReview', $row->page_title),
                    htmlspecialchars($title->getText())
            );
        $s .= "</li>\n";
        
        //$s = "<pre>".var_export($row, true)."</pre>";
        
        if ($this->mLastShown == $row->annotation_id) {
            $s .= "</ul>";
        }
        
        return $s;
        
    }

    public function getIndexField() {
        return 'annotation_id';
        
    }

    public function getQueryInfo() {
        $info = array(
            'tables' => array('annotator', 'revision', 'page'),
            'fields' => array(
                'annotation_id',
                'rev_id',
                'rev_timestamp',
                // Select page fields for Title::newFromRow
                'page_id',
                'page_namespace', 
                'page_title', 
		'page_len', 
                'page_is_redirect', 
                'page_latest',
                'page_content_model',
                'num_pages' => 'COUNT(page_id)'
             ),
            'conds' => array(
                'annotation_rev_id = rev_id',
                'rev_page = page_id'
            ),
            'options' => array(
                'GROUP BY' => 'page_id',
            )
        );
                
        return $info;
    }

    
}