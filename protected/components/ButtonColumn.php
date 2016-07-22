<?php
/**
 * ButtonColumn class file.
 * Extends {@link CButtonColumn}
 * 
 * Allows additional evaluation of ID in options.
 * 
 * @version $Id$
 * 
 */
class ButtonColumn extends CButtonColumn
{
    /**
     * @var boolean whether the ID in the button options should be evaluated.
     */
    public $evaluateID = true;
 
    /**
     * Renders the button cell content.
     * This method renders the view, update and delete buttons in the data cell.
     * Overrides the method 'renderDataCellContent()' of the class CButtonColumn
     * @param integer $row the row number (zero-based)
     * @param mixed $data the data associated with the row
     */
    public function renderDataCellContent($row, $data)
    {
        $tr=array();
        ob_start();
        foreach($this->buttons as $id=>$button)
        {
            //'htmlOptions'=>array('id'=>'"ordering_{$data->client_file_id}"'),
            //'id'=>'\'button_for_id_\'.$data->id',
            if($this->evaluateID and isset($button['options']['id'])) 
            {
                $button['options']['id'] = $this->evaluateExpression($button['options']['id'], array('row'=>$row,'data'=>$data));
            }
            if($this->evaluateID and isset($button['options']['data-url'])) 
            {
                $button['options']['data-url'] = $this->evaluateExpression($button['options']['data-url'], array('row'=>$row,'data'=>$data));
            }
 
            $this->renderButton($id,$button,$row,$data);
            $tr['{'.$id.'}']=ob_get_contents();
            ob_clean();
        }
        ob_end_clean();
        echo strtr($this->template,$tr);
    }
}