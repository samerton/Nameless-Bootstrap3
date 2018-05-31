<div class="panel panel-default">
    <div class="panel-body">
        <h2 style="margin-top:5px;">{$ONLINE_STAFF}</h2>
        {if isset($ONLINE_STAFF_LIST)}
            {foreach from=$ONLINE_STAFF_LIST name=online_staff_arr item=user}
                <a style="{$user.style}" href="{$user.profile}"><img src="{$user.avatar}" alt="{$user.nickname}" class="img-rounded" style="max-height:20px;max-width:20px;"> {$user.username}</a>
                {if not $smarty.foreach.online_staff_arr.last}, {/if}
            {/foreach}
        {else}
            {$NO_STAFF_ONLINE}
        {/if}
    </div>
</div>