
<?php echo $this->Html->link('Back', array('controller'=>'Extras','action'=>'index')) ?>

	

<div class="container">
	<div class="contactwrapper">
	<div class="view">

	<div class="PostBox">
		<div class="PostContent">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
						<?php echo $this->Form->create('Extra');?>	
						<legend>
							<?php echo __('Add Custom Extra'); ?>
						</legend>
						
						<?php 
						echo $this->Form->create('Extra', array('class' => 'form'));
						
						echo $this->Form->input('name',array('placeholder' => __('Enter name'),'label' => __('Name')));
						echo $this->Form->input('description',array('placeholder' => __('Enter a description'),'label' => __('Description')));
						echo $this->Form->input('default_price',array('placeholder' => __('Enter the default price'),'label' => __('Default Price')));
						echo $this->Form->input('depends_on',array('options'=> $list_extras_view,'label'=>__('Can be selected only after buying:')));
						$array_options=array(
							0=>'No',
							1=>__('Floor size dependent'),
							2=>__('Total size dependent')
						);
						echo $this->Form->input('size_dependent_check',array('type'=>'select','options'=>$array_options ,'default' => 0,'label' => __('Is the price size dependent?')));
						echo $this->Form->input('bool_garage',array('label'=>__('Is a garage?')));
						echo $this->Form->input('bool_unique',array('label'=>__('Only one can be purchased?')));
						echo $this->Form->input('bool_uneditable',array('label'=>__('Will the price be fixed?')));
						echo $this->Form->input('category_id', array('options'=> $list_categories_view,'label' => __('Category')));
						
						?>		
						
				</div>						
			</div>
		</div>
		<p style="clear: both;"> </p>

		<div class="PostFooter">
			<div class="bottomaction"> <?php echo $this->Form->end(array('label' => __('Add'),'text' => 'test','class' => 'btn btn-success')); ?> <p style="clear: both;">  </p></div>
			<p style="clear: both;">  </p>
		</div>
	</div>
		
	</div>
	</div>
	</div>
