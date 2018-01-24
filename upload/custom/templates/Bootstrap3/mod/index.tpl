{include file='navbar.tpl'}

<div class="container">
  <div class="row">
	<div class="col-md-3">
	  {include file='mod/navigation.tpl'}
	</div>
	<div class="col-md-9">
	  <div class="panel panel-default">
		<div class="panel-body">
		  <h2 style="margin-top:5px;">{$OVERVIEW}</h2>
		  {$OPEN_REPORTS}
		</div>
	  </div>
	</div>
  </div>
</div>

{include file='footer.tpl'}