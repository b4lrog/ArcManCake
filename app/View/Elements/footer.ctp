

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8"><p style="clear: both;">  </p></div>
		<div class="col-md-2"></div>
    </div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8"><p style="clear: both;">  </p></div>
		<div class="col-md-2"></div>
    </div>
	<hr>
     <!-- FOOTER -->
    <footer>
        <p class="pull-right"><a  href="#">An den Anfang der Seite</a>
		
			
		</p>
		
		<p>
		<?php 
			if($this->Session->check('Auth.User')){
				echo 'Hello <b>'.$current_user['username'].'</b> ('.$level[$current_user['role']].') &middot; '.$this->Html->link('Logout',array('plugin'=>NULL,'controller'=>'users','action'=>'logout'));
				
				
				if(!empty($current_user['id'])){
					?> &middot; <?php
					echo $this->Html->link(__('Users'),array('plugin'=>NULL,'controller'=>'Users','action'=>'index'));
				}
				
				if($current_user['role'] == 3){
					?> &middot; <?php
					echo $this->Html->link(__('Customers'),array('plugin'=>NULL,'controller'=>'Customers','action'=>'index'));
				}
				
				if($current_user['role']<2){
					?> &middot; <?php
					echo $this->Html->link(__('Proposals'),array('plugin'=>NULL,'controller'=>'Proposals','action'=>'index'));
					?> &middot; <?php
					echo $this->Html->link(__('Extra categories'),array('plugin'=>NULL,'controller'=>'Categories','action'=>'index'));
				}
				
				if($current_user['role']<2){
					?> &middot; <?php
					echo $this->Html->link(__('Home pictures'),array('plugin'=>NULL,'controller'=>'HomePictures','action'=>'index'));
				}
				
				if($current_user['role']<2){
					?> &middot; <?php
					echo $this->Html->link(__('House pictures'),array('plugin'=>NULL,'controller'=>'HousePictures','action'=>'index'));
				}
				
				if ($current_user['role']<2) {
					?> &middot; <?php
					echo $this->Html->link(__('Job offers'),array('plugin'=>NULL,'controller'=>'JobOffers','action'=>'index'));
				}
				
				
			} else {
				echo $this->Html->link(__('Login'),array('plugin'=>NULL,'controller'=>'users','action'=>'login'));
				
			}
		?>
		</p>
		
		
		<p>
		&copy; 2014 C. Robens and R. Gómez &middot; 
		<?php echo $this->Html->link('Impressum',array('plugin'=>NULL,'controller'=>'Home','action'=>'impressum'))?>
		<?php if($this->Session->check('Auth.User')){
					?> &middot; <?php
					echo $this->Html->link(__('Contact'),array('plugin'=>NULL,'controller'=>'Home','action'=>'contact'));
				}
		?>
		</p>
		
		<?php 
			echo $this->Html->link(
					$this->Html->image('Logo_Experte.jpg', array('width'=>'140px','height'=>'140px', 'class' => 'featurette-image img-responsive')),
					'http://www.energie-effizienz-experten.de',
					array('target' => '_blank', 'escape' => false));
			  
		?>
		<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
		?>
    </footer>
</div><!-- /.container -->