{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 style="display:inline;">{$PURCHASING_RESOURCE}</h2>
            <div class="pull-right">
                <a href="{$CANCEL_LINK}" onclick="return confirm('{$CONFIRM_CANCEL}');" class="btn btn-warning">{$CANCEL}</a>
            </div>

            <hr />

            {if isset($ERROR)}
                <div class="alert alert-danger">{$ERROR}</div>
            {/if}

            {$PRE_PURCHASE_INFO}

            <hr />

            <form action="" method="post">
                <input type="hidden" name="token" value="{$TOKEN}">
                <input type="hidden" name="action" value="agree">
                <input type="submit" class="btn btn-primary" value="{$PURCHASE}">
            </form>
        </div>
    </div>
</div>

{include file='footer.tpl'}