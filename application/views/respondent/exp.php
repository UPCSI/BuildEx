<h1> Respondent View </h1>
<p> Do the slideshow here </p>
<h2> Vars: </h2>
<p> $exp: contains the experiment's meta-data such as eid,status,current_count,target_count...etc. </p> 
<p> $var: all the objects of this experiment - not yet implemented </p>

<h3> $exp: </h3>
<pre>
<?php var_dump($exp); ?>
</pre>

<h2> Note: </h2>
<p> Please see view/includes/respondent_header for additional css imports. </p>
<p> Please see view/includes/respondent_footer for additional js imports. </p>
<p> Please see view/components/topbar_respondent for the desired topbar of this view.</p>
<br>
<button class = "small" onclick = "save();"> Save </button> <!--subject for change; just temporary -->
<button class = "small" onclick = "pause();"> Pause </button>
<button class = "small" onclick = "reset();"> Reset </button> <!--subject for change; just temporary -->