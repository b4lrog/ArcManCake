<div class="row">
	<br>
	<?php echo $this->Html->link('Back', array('controller'=>'Houses','action'=>'index')) ?>
</div>
	

	<div class="row">
		<div class="col-md-8">
		<div class="panel panel-success">
           	<div class="panel-heading">
				<h3 class="panel-title">
					<?php echo __( 'House').': '.$house_view['House']['name'];?>
				</h3>
			</div>
			<div class="panel-body">
			
			
<!----------PANEL CONTENT-------------->			
	<div class="row"id=" ">
	<?php if(true){?>
        
        
        
        <div class="col-md-1">
			<div class="row">
				
			</div>
        </div>
		<div class="col-md-10">
			
			<div class="row">
				<strong >
				<?php echo __('Size:'); ?>
				
					<?php echo $house_view['House']['size'].__(' m<sup>2</sup> in ').$house_view['House']['floors'].__(' floors.');?>
				</strong >
			</div>
			<div class="row">
			
					<?php if(!empty($house_pictures_view)){
					foreach ($house_pictures_view as $x){
						if($x['type_flag']==0){
							echo $this->Html->image('/img/uploads/houses/'.$x['picture'], array('class' => 'featurette-image img-responsive'));
							break;
						}
					}
					} ?>
				
			</div>
			
			<div class="row">
				<strong > <?php echo __('Description:'); ?> </strong>
				<?php echo $this->Text->autoParagraph($house_view['House']['description']); ?> 
			</div>
			
			<div class="row">
				<div class="col-xs-9">  </div>
				
				<div class="col-md-1" align=right>
					<strong><?php echo __('Price'); ?></strong>
				</div>
				
				<div class="col-md-2">
					<?php echo $house_view['House']['price'].' €'; ?>
				</div>
			</div>
		</div>
		
		<div class="col-md-1"></div>
		<?php } ?>
	</div>			
	
	
	
	
<!----------END PANEL CONTENT-------------->			
			
			
			</div>
		</div>
		</div>
		<div class="col-md-4">
			<div class="row">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo __( 'Gallery');?></h3>
				</div>
				<div class="panel-body">
					<?php foreach ($house_pictures_view as $x){
						if($x['type_flag']==0){?>
							<div class="col-md-6">
							<?php 
							echo $this->Html->link(
								$this->Html->image('/img/uploads/houses/'.$x['picture'], array( "class" => "featurette-image img-responsive", "alt"=>" ")),
								'/img/uploads/houses/'.$x['picture'],
								array('escape'=>false,'data-lightbox'=>'normal_pics','data-title'=>$x['name'].': '.$x['description'])
							);?>
							</div>
							<?php 
						}
					}?>
					
				</div>
			</div>
			</div>

			<div class="row">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo __( 'Floorplans');?></h3>
				</div>
				<div class="panel-body">
					<?php foreach ($house_pictures_view as $x){
						if($x['type_flag']==-2){ ?>
							<div class="col-md-6">
							<?php echo $this->Html->link(
								$this->Html->image('/img/uploads/houses/'.$x['picture'], array( "class" => "featurette-image img-responsive", "alt"=>" ")),
								'/img/uploads/houses/'.$x['picture'],
								array('escape'=>false,'data-lightbox'=>'normal_pics','data-title'=>$x['name'].': '.$x['description'])
							);?>
							</div>
						<?php }
					}?>
				</div>
			</div>
			</div>
			
		</div>
	</div>

