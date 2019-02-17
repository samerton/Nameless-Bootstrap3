{* Punishment modal if necessary *}
{if isset($GLOBAL_WARNING_TITLE)}
  <div class="modal fade show-punishment" data-keyboard="false" data-backdrop="static" id="acknowledgeModal" tabindex="-1" role="dialog" aria-labelledby="acknowledgeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="acknowledgeModalLabel">{$GLOBAL_WARNING_TITLE}</h4>
        </div>
        <div class="modal-body">
          {$GLOBAL_WARNING_REASON}
        </div>
        <div class="modal-footer">
          <a href="{$GLOBAL_WARNING_ACKNOWLEDGE_LINK}" class="btn btn-warning">{$GLOBAL_WARNING_ACKNOWLEDGE}</a>
        </div>
      </div>
    </div>
  </div>
{/if}

<br />
<footer>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-body">
	    {*Social media*}
		{if !empty($SOCIAL_MEDIA_ICONS)}
		  {foreach from=$SOCIAL_MEDIA_ICONS item=icon}
		    <a href="{$icon.link}" target="_blank"><i id="social-{$icon.short}" class="fa fa-{$icon.long}-square fa-3x social"></i></a>
		  {/foreach}
		{/if}
        <span class="pull-right">
		  <ul class="nav nav-pills dropup">
		    {if $PAGE_LOAD_TIME}
		    <li class="nav-item">
			  <a class="nav-link" href="#" onClick="return false;" data-toggle="tooltip" id="page_load_tooltip" title="Page loading.."><i class="fa fa-tachometer fa-fw"></i></a>
			</li>
		    {/if}

			{foreach from=$FOOTER_NAVIGATION key=name item=item}
			  {if isset($item.items)}
				{* Dropup *}
				<li>
				  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{$item.title}</a>
				  <ul class="dropdown-menu">
					{foreach from=$item.items item=dropdown}
					  <li><a class="dropdown-item" href="{$dropdown.link}" target="{$dropdown.target}">{$dropdown.title}</a></li>
					{/foreach}
				  </ul>
				</li>
			  {else}
				{* Normal link *}
				<li>
				  <a {if isset($item.active)} class="active"{/if} href="{$item.link}" target="{$item.target}">{$item.title}</a>
				</li>
			  {/if}
			{/foreach}
			
			<li>
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				&copy; {$SITE_NAME} {'Y'|date}
			  </a>
			  <ul class="dropdown-menu" aria-labelledby="Preview">
				<li><a target="_blank" href="https://namelessmc.com/">Powered by NamelessMC</a></li>
				<li><a href="{$TERMS_LINK}">{$TERMS_TEXT}</a></li>
				<li><a href="{$PRIVACY_LINK}">{$PRIVACY_TEXT}</a></li>
			  </ul>
			</li>
		  </ul>
        </span>
      </div>
    </div>
  </div>
</footer>
<br />

{foreach from=$TEMPLATE_JS item=script}
	{$script}
{/foreach}

{if isset($NEW_UPDATE)}
	{if $NEW_UPDATE_URGENT ne true}
		<script type="text/javascript">
			$(document).ready(function(){
				$('#closeUpdate').click(function(event){
					event.preventDefault();

					let expiry = new Date();
					let length = 3600000;
					expiry.setTime(expiry.getTime() + length);

					$.cookie('update-alert-closed', 'true', { path: '/', expires: expiry });
				});

				if($.cookie('update-alert-closed') === 'true'){
					$('#updateAlert').hide();
				}
			});
		</script>
	{/if}
{/if}

</body>
</html>