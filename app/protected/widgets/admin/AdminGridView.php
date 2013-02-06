<?php
Yii::import('zii.widgets.grid.CGridView');
class AdminGridView extends CGridView {
    
    public $rowDataLinkExpression = false;    
    
    public function __construct() {
        parent::__construct();
        
        $this->hideHeader=false;
        $this->summaryText='{start}-{end} of {count}';
        $this->template='<div class="grid-details">{pager}{summary}</div><div class="table">{items}</div>';
        $this->cssFile=false;
        $this->pager = array(
            'cssFile'=>false, 
            'prevPageLabel'=>'<span class="icon prev"></span>',   
            'nextPageLabel'=>'<span class="icon next"></span>',
            'header'=>false,
        );
        
        
    }
    
         /**
         * Renders a table body row.
         * @param integer the row number (zero-based).
         */
        public function renderTableRow($row)
        {
            echo '<tr ';
                
                if($this->rowDataLinkExpression!==null)
                {
                    $data=$this->dataProvider->data[$row];
                    echo 'data-link="'.$this->evaluateExpression($this->rowDataLinkExpression,array('row'=>$row,'data'=>$data)).'"'; 
                }
                if($this->rowCssClassExpression!==null)
                {
                    $data=$this->dataProvider->data[$row];
                    echo ' class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'"';
                }
                else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
                        echo ' class="'.$this->rowCssClass[$row%$n].'"';
                  
                echo ' >';    
                foreach($this->columns as $column)
                        $column->renderDataCell($row);
                echo "</tr>\n";
        }
        
        private function renderDataLinkJs()
        {
            Yii::app()->clientScript->registerScript('rowCLick',
                    '$(".table table tbody tr").live("click", function(){
                        window.location.href = $(this).data("link");
                    });', 
                CClientScript::POS_READY
            );
        }
    
        public function renderContent()
        {
            if($this->rowDataLinkExpression)
                $this->renderDataLinkJs();
                
            return parent::renderContent();
        }
        
        public function renderPager()
        {
                if(!$this->enablePagination)
                        return;

                $pager=array();
                $class='CLinkPager';
                if(is_string($this->pager))
                        $class=$this->pager;
                else if(is_array($this->pager))
                {
                        $pager=$this->pager;
                        if(isset($pager['class']))
                        {
                                $class=$pager['class'];
                                unset($pager['class']);
                        }
                }
                $pager['pages']=$this->dataProvider->getPagination();

                if($pager['pages']->getPageCount()>1)
                {
                        echo '<div class="'.$this->pagerCssClass.'">';
                        $this->widget($class,$pager);
                        echo '</div>';
                }
                else
                {
                        echo '<div class="'.$this->pagerCssClass.' inactive">';
                        echo '<ul><li class="previous"><span class="icon prev"></span></li><li class="next"><span class="icon next"></span></li></ul>';
                        $this->widget($class,$pager);
                        echo '</div>';
                }
                        
        }
}

?>