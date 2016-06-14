<?php

namespace Birke\Mediawiki\AnnotatorReview;

/**
 * This class displays the annotations for a page
 */
class AnnotatorPager extends \ReverseChronologicalPager {
    
    /**
     * Title of the page the comments are shown for
     * 
     * @var \Title
     */
    protected $title;
    
    /**
     * Last revision that was output by formatRow
     * @var 
     */
    protected $lastRevision;
    
    /**
     * 
     * @param \ContextSource $contextSource
     * @param \Title $title Title of the current page
     */
    function __construct($contextSource, $title) {
        parent::__construct($contextSource);
        $this->title = $title;
    }
    
    
    public function formatRow($row) {
        
        $s = "";
        if ($this->mFirstShown == $row->annotation_id) {
            $s .= "<dl>";
        }
        
        if ($row->annotation_rev_id != $this->lastRevision) {
            $s .= "<dt>";
            $ts = wfTimestamp( TS_MW, $row->rev_timestamp );
            // TODO Link to revision
            $date = $this->getLanguage()->userTimeAndDate($ts, $this->getUser());
            $s .= \Linker::linkKnown($this->title,
                    htmlspecialchars($date),
                    array( 'class' => 'mw-changeslist-date' ),
                    array( 'oldid' => $row->annotation_rev_id )
            );
            $s .= "</dt>\n";
            $this->lastRevision = $row->annotation_rev_id;
        }
        
        $data = json_decode($row->annotation_json);
        $s .= "<dd>";
        $s .= \Linker::userLink($row->annotation_user_id, $row->annotation_user_text, $row->annotation_user_text);

        $s .= ' <span class="mw-changeslist-separator">. .</span> ';
        $s .= \Html::element('span', array(
            'class' => 'annotation-text',
            'title' => $this->msg('annotatorreview-set-on', $data->quote),
        ), $data->text);
        $s .= "</dd>\n";
        
        //$s = "<pre>".var_export($row, true)."</pre>";
        
        if ($this->mLastShown == $row->annotation_id) {
            $s .= "</dl>";
        }
        
        return $s;
        
    }

    public function getIndexField() {
        return 'annotation_id';
        
    }

    public function getQueryInfo() {
        $info = array(
            'tables' => array('annotator'),
            'fields' => array(
                'annotation_id', 
                'annotation_json', 
                'annotation_rev_id',
                'annotation_user_id',
                'annotation_user_text'
             )
        );
        
        if ($this->title) {
            $info['tables'][] = 'revision';
            $info['fields'][] = 'rev_timestamp';
            $info['conds'] = array(
                'annotation_rev_id = rev_id',
                'rev_page = '.$this->title->getArticleID()
            );
        }
        
        return $info;
    }

    
}