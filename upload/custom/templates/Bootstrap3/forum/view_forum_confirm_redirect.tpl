{include file='navbar.tpl'}

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            {$CONFIRM_REDIRECT}
            <hr />
            <div class="btn-group btn-group-lg" role="group" aria-label="...">
                <a href="{$FORUM_INDEX}" class="btn btn-default">{$NO}</a>
                <a href="{$REDIRECT_URL}" target="_blank" rel="noopener nofollow" class="btn btn-primary">{$YES}</a>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}