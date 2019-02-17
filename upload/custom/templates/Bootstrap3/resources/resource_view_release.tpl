{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
	  <h2 style="margin-top:5px;display:inline;">{$VIEWING_RELEASE}</h2>
	  <span class="pull-right">
		<a href="{$BACK_LINK}" class="btn btn-danger">{$BACK}</a>
	  </span>
	  
	  <br /><br />
	  
	  <div class="forum-post">
	    {$DESCRIPTION}
	  </div>
	  
	  <hr />
	  
	  <span data-toggle="tooltip" data-trigger="hover" data-original-title="{$DATE_FULL}">{$DATE}</span>
	  
	  <span class="pull-right">
		  {if isset($DOWNLOAD_URL)}
			  <a href="{$DOWNLOAD_URL}" class="btn btn-primary" target="_blank">{$DOWNLOAD}</a>
		  {elseif isset($PURCHASE_FOR_PRICE)}
			  <a {if isset($PURCHASE_LINK)}href="{$PURCHASE_LINK}" {else}disabled {/if}class="btn btn-primary">{$PURCHASE_FOR_PRICE}</a>
		  {elseif isset($PAYMENT_PENDING)}
			  <button type="button" disabled class="btn btn-primary">{$PAYMENT_PENDING}</button>
		  {/if}
      </span>
	  
    </div>
  </div>
</div>

{include file='footer.tpl'}