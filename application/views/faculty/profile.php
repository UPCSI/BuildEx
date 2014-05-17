<div class="row">
  <div class="large-12 column">
    <div class="panel dash-item" style="padding:0;border-width:0">
      <div class="panel profile" style="min-height:180px;margin-bottom:0">
        <h4 class="white">
          <strong> <?php echo strtoupper($user->last_name).' </strong>, '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </strong>
        </h4>
        <h5 class="white"> <?php echo $this->session->userdata('username'); ?> </h5>
      </div>
      <dl class="tabs profile" data-tab>
        <dd class="active"><a href="#panel2-1">About</a></dd>
        <dd><a href="#panel2-2">Experiments</a></dd>
      </dl>
      <div class="tabs-content profile" data-equalizer>
        <div class="content active" id="panel2-1">
  	     <?php $this->load->view('faculty/_info'); ?>
         <br>
	       <?php $this->load->view('users/_roles'); ?>
        </div>
        <div class="content" id="panel2-2">
          <?php $this->load->view('faculty/_top_experiments'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
