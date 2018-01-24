{include file='navbar.tpl'}

<div class="container">
    <div class="row">
        <div class="col-md-3">
            {include file='mod/navigation.tpl'}
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 style="margin-top:5px;">{$VIEWING_ALL_PUNISHMENTS}</h2>
                    <hr />
                    {if isset($RESULTS)}
                        <table class="table table-bordered table-responsive">
                            <colgroup>
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 20%;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>{$USERNAME}</th>
                                <th>{$STAFF}</th>
                                <th>{$TYPE}</th>
                                <th>{$WHEN}</th>
                                <th>{$ACTIONS}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$RESULTS item=result}
                                <tr>
                                    <td><a href="{$result.profile}" style="{$result.style}">{$result.nickname}</a></td>
                                    <td><a href="{$result.staff_profile}" style="{$result.staff_style}">{$result.staff_nickname}</a></td>
                                    <td>
                                        {if $result.type_numeric == 1}
                                            <span class="label label-danger">{$result.type}</span>
                                        {elseif $result.type_numeric == 2}
                                            <span class="label label-warning">{$result.type}</span>
                                        {elseif $result.type_numeric == 3}
                                            <span class="label label-danger">{$result.type}</span>
                                        {/if}
                                        {if $result.revoked == 1}
                                            <span class="label label-info">{$REVOKED}</span>
                                        {/if}
                                        {if $result.acknowledged == 1}
                                            <span class="label label-success">{$ACKNOWLEDGED}</span>
                                        {/if}
                                    </td>
                                    <td><span rel="tooltip" data-title="{$result.time_full}">{$result.time}</span></td>
                                    <td><a href="{$result.link}" class="btn btn-info">{$VIEW_USER}</a></td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                        <br />
                        {$PAGINATION}
                    {else}
                        <div class="alert alert-info">{$NO_PUNISHMENTS}</div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}