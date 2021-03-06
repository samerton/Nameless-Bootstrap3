{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 style="display:inline;">{$FORUM_SEARCH}</h2>
            <br /><br />

            {if isset($ERROR)}
                <div class="alert alert-danger">
                    {$ERROR}
                </div>
            {/if}

            <form class="form-horizontal" role="form" method="post" action="{$FORM_ACTION}">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" name="forum_search" placeholder="{$SEARCH}">
                    <input type="hidden" name="token" value="{$TOKEN}">
                    <span class="input-group-btn">
		                <button type="submit" class="btn btn-default btn-lg">
		                    <i class="fa fa-search"></i>
		                </button>
		            </span>
                </div>
            </form>
        </div>
    </div>
</div>

{include file='footer.tpl'}