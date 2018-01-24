{include file='navbar.tpl'}

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 style="margin-top:5px;">{$VERIFY_ACCOUNT}</h2>
            <div class="alert alert-info">{$VERIFY_ACCOUNT_HELP}</div>
            {if !isset($STEP)}
                {* Step 1 *}
                {$MCASSOC}
            {else}
                {* Step 2 *}
                {if isset($ERROR)}
                    <div class="alert alert-danger">
                        {$ERROR}
                        <br />
                        <a class="btn btn-secondary" href="{$RETRY_LINK}">{$RETRY_TEXT}</a>
                    </div>
                {elseif isset($SUCCESS)}
                    <div class="alert alert-success">
                        {$SUCCESS}
                        <br />
                        <a class="btn btn-primary" href="{$LOGIN_LINK}">{$LOGIN_TEXT}</a>
                    </div>
                {/if}
            {/if}
        </div>
    </div>
</div>

{include file='footer.tpl'}