<?php if (!defined('THINK_PATH')) exit(); foreach ($attr_list as $v) { if($v['attr_type']==0){ if($v['attr_input_type']==0){ echo '<div class="form-group has-success">'; echo '<div class="col-md-2 col-md-offset-3 text-right">'; echo ' <label for="" class="control-label">'.$v['attr_name'].'</label></div>'; echo ' <div class="col-md-4">'; echo '<input type="text" name="attr['.$v['attr_id'].']" id="" class="form-control"/>'; echo '</div>'; echo '</div>'; } else{ echo '<div class="form-group has-success">'; echo '<div class="col-md-2 col-md-offset-3 text-right">'; echo '<label for="" class="control-label">'.$v['attr_name'].'</label>
					</div>'; echo '<div class="col-md-4">'; $attrs=$v['attr_value']; $attrs=str_replace('，', ',', $attrs); $attrsarray=explode(',', $attrs); echo '<select name="attr['.$v['attr_id'].']" id="" class="form-control">'; foreach ($attrsarray as $key => $value) { echo '<option value="'.$value.'">'.$value.'</option>'; } echo '</select>'; echo '</div>'; echo '</div>'; } }else{ if($v['attr_input_type']==0){ echo '<div class="form-group has-success">'; echo '<div class="col-md-2 col-md-offset-3 text-right">'; echo ' <label for="" class="control-label"><a href="javascript:;" onclick="copydiv(this)"><span class="glyphicon glyphicon-plus"></span></a> '.$v['attr_name'].'</label></div>'; echo ' <div class="col-md-4">'; echo '<input type="text" name="attr['.$v['attr_id'].'][]" id="" class="form-control"/>'; echo '</div>'; echo '</div>'; } else{ echo '<div class="form-group has-success">'; echo '<div class="col-md-2 col-md-offset-3 text-right">'; echo '<label for="" class="control-label"> <a href="javascript:;" onclick="copydiv(this)"><span class="glyphicon glyphicon-plus"></span></a> '.$v['attr_name'].'</label>
					</div>'; echo '<div class="col-md-4">'; $attrs=$v['attr_value']; $attrs=str_replace('，', ',', $attrs); $attrsarray=explode(',', $attrs); echo '<select name="attr['.$v['attr_id'].'][]" id="" class="form-control">'; foreach ($attrsarray as $key => $value) { echo '<option value="'.$value.'">'.$value.'</option>'; } echo '</select>'; echo '</div>'; echo '</div>'; } } } ?>
<script type="text/javascript">
	function copydiv(o){
		//取出当前的表单组div
		var divs=$(o).parent().parent().parent();
		//判断a标签的内容是否为+
		if($(o).html()=='<span class="glyphicon glyphicon-plus"></span>'){
			//是+就复制当前的div
			var new_divs=divs.clone();	//克隆当前的表单组div
			//将克隆的new_div中a标签内容的+换成-
			new_divs.find('a').html('<span class="glyphicon glyphicon-minus"></span>');
			//将新的div放在当前行的后面
			divs.after(new_divs);
		}else{
			//不是+就是-，移除当前的div
			divs.remove();
		}
	}
</script>