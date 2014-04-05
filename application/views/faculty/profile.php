<div class="row">
<div class="large-12 column">
<div class="panel dash-item" style="padding:0;border-width:0">
<div class="panel profile" style="min-height:180px;margin-bottom:0">
<h4 class="white"> <strong> <?php echo strtoupper($user->last_name).' </strong>, '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </h4>
<h5 class="white"> @<? echo $this->session->userdata('username'); ?></h5>
</div>
<dl class="tabs profile" data-tab>
  <dd class="active"><a href="#panel2-1">About</a></dd>
  <dd><a href="#panel2-2">Experiments</a></dd>
</dl>
<div class="tabs-content profile" data-equalizer>
  <div class="content active" id="panel2-1">
    
  	<p> <strong> Email Address: </strong> <?php echo $user->email_ad; ?> </p>
	<p> <strong> Faculty No: </strong> <?php echo $faculty->faculty_num; ?> </p>
	Roles:
	<ol>
		<?php foreach ($roles as $role): ?>
			<li> <a href ="<?php echo site_url('home/redirect')  .'/' .$role?>"> <?php echo ucfirst($role); ?> </a> </li>
		<?php endforeach; ?>
	</ol>

  </div>
  <div class="content" id="panel2-2">
    <p>Second panel content goes here...</p>
  </div>
</div>

</div>
</div>
</div>
