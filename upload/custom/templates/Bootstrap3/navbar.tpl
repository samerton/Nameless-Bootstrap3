<nav class="navbar navbar-{$NAV_STYLE} navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{$SITE_HOME}">{$SITE_NAME}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
 	    {foreach from=$NAV_LINKS key=name item=item}
		  {if isset($item.items)}
		    {* Dropdown *}
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{$item.title} <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				{foreach from=$item.items item=dropdown}
				  <li><a href="{$dropdown.link}" target="{$dropdown.target}">{$dropdown.title}</a></li>
				{/foreach}
			  </ul>
			</li>
		  {else}
		    {* Normal link *}
			<li{if isset($item.active)} class="active"{/if}>
			  <a href="{$item.link}" target="{$item.target}">{$item.title}</a>
			</li>
		  {/if}
		{/foreach}
      </ul>
      <ul class="nav navbar-nav navbar-right">
	    {if isset($MESSAGING_LINK)}
	    {* Private messages and alerts *}
		<li class="dropdown pm-dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="margin: -10px 0px; font-size: 16px;"><i class="fa fa-envelope"></i> <div style="display: inline;" id="pms"></div></span></a>
		  <ul class="dropdown-menu pm-dropdown-menu" id="pm_dropdown">
		    <li id="pm_loading"><a>{$LOADING}</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="{$MESSAGING_LINK}">{$VIEW_MESSAGES}</a></li>
		  </ul>
		</li>

		<li class="dropdown alert-dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="margin: -10px 0px; font-size: 16px;"><i class="fa fa-flag"></i> <div style="display: inline;" id="alerts"></div></span></a>
		  <ul class="dropdown-menu alert-dropdown-menu" id="alert_dropdown">
		    <li id="alert_loading"><a>{$LOADING}</a></li>
		    <li role="separator" class="divider"></li>
			<li><a href="{$ALERTS_LINK}">{$VIEW_ALERTS}</a></li>
		  </ul>
		</li>
		{/if}

		{foreach from=$USER_AREA key=name item=item}
		  {if isset($item.items)}
			{* Dropdown *}
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{$item.title}</a>
			  <ul class="dropdown-menu">
				{foreach from=$item.items item=dropdown}
				  {if isset($dropdown.separator)}
				    <li role="separator" class="divider"></li>
				  {else}
				    <a href="{$dropdown.link}" target="{$dropdown.target}">{$dropdown.title}</a>
				  {/if}
				{/foreach}
			  </ul>
			</li>
		  {else}
			{* Normal link *}
			<li{if isset($item.active)} class="active"{/if} style="padding-right:10px;">
			  <a href="{$item.link}" target="{$item.target}">{$item.title}</a>
			</li>
		  {/if}
		{/foreach}

		{if isset($USER_DROPDOWN)}
            {foreach from=$USER_DROPDOWN key=name item=item}
                {if isset($item.items)}
                    {* Dropdown *}
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {if isset($LOGGED_IN_USER)}<img src="{$LOGGED_IN_USER.avatar}" alt="{$LOGGED_IN_USER.username}" class="img-rounded" style="margin: -10px 0px;max-height:25px;max-width:25px;"/>{/if} {$item.title} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
                            {foreach from=$item.items item=dropdown}
                                {if isset($dropdown.separator)}
									<li role="separator" class="divider"></li>
                                {else}
									<li><a href="{$dropdown.link}" target="{$dropdown.target}">{$dropdown.title}</a></li>
                                {/if}
                            {/foreach}
						</ul>
					</li>
                {else}
                    {* Normal link *}
					<li{if isset($item.active)} class="active"{/if} style="padding-right:10px;">
						<a href="{$item.link}" target="{$item.target}">{$item.title}</a>
					</li>
                {/if}
            {/foreach}
		{/if}
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" style="padding-top: 7rem !important;">
  {* Global messages *}
  {if isset($MAINTENANCE_ENABLED)}
  <div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
	  </button>
	  {$MAINTENANCE_ENABLED}
  </div>
  {/if}
  {if isset($MUST_VALIDATE_ACCOUNT)}
  <div class="alert alert-info">
	  {$MUST_VALIDATE_ACCOUNT}
  </div>
  {/if}
</div>