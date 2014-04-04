<!--Please retouch this maker and integrate with foundation UI instead of bootstrap -->
<div class="container">
  <div class="row clearfix">
    <!-- Building Form. -->
    <div class="span5">
      <div class="clearfix">
        <h2>Your Form</h2>
        <hr>
        <div id="build">
          <form id="target" class="form-horizontal">
          </form>
        </div>
      </div>
  </div>
<!-- / Building Form. -->

<!-- Components -->
  <div class="span5">
    <h2>Components</h2>
    <hr>
    <div class="tabbable">
      <ul class="nav nav-tabs" id="formtabs">
      <!-- Tab nav -->
      </ul>
      <form class="form-horizontal" id="components">
      <fieldset>
        <div class="tab-content">
          <!-- Tabs of snippets go here -->
        </div>
      </fieldset>
      </form>
    </div>
    <div class = "maker-settings">
      <a class = "button tiny" href = "<?php echo site_url('maker/save'); ?>"> Save </a>
      <a class = "button tiny" href = "<?php echo site_url('maker/reset'); ?>"> Reset </a>
    </div>
  </div>
  <!-- / Components -->
  </div>
</div> <!-- /container -->



<script type = "text/javascript" data-main="<?php echo site_url('js/maker/main-built.js'); ?>"
        src="<?php echo site_url('js/maker/lib/require.js'); ?>" ></script>
