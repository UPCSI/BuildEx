<div class="row">
<div class="large-6 column">

<div class="panel dash-item" style="border-bottom:7px;border-style: solid; border-color:#e74c3c">
<h1>Welcome!</h1>
<p> You are currently logged in as <strong> <?php echo $this->session->userdata('username'); ?> </strong> with a role of <strong> <?php echo ucfirst($this->session->userdata('active_role')); ?> </strong> </p>
</div>

<div class="panel dash-item">
<h1>Notifications</h1>
<p> 7 unread </p>
</div>

<div class="panel dash-item">
<h1>Experiments</h1>
<p> 2 active </p>
</div>


</div>


<div class="large-6 column">

<div class="panel dash-item">
<h1>NDSG</h1>
<p> Networks and Distributed Systems <br/>
Laboratory Head: mtcarreon <br/>
Members: 25
</p>
</div>

<div class="panel dash-item">
<h1>Statistics</h1>
<p> This week </p>
</div>

</div>
</div>