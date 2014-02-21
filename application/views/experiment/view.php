<h1>Experiment</h1>
<hr>
<h2> <?php echo $experiment->title; ?></h2>
<p> Category: <?php echo $experiment->category; ?> </p>
<p> Description: <?php echo $experiment->description; ?> </p>
<p> Target Count: <?php echo $experiment->target_count; ?> </p>
<p> Current Count: <?php echo $experiment->current_count; ?> </p>
<p> Is published: <?php if($experiment->is_published == 'f'){echo 'False';}else{echo 'True';} ?> </p>
<p> Adviser: </p>