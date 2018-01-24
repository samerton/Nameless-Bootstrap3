<div class="panel panel-default">
  <div class="panel-body">
    <h2 style="margin-top:5px;">{$CATEGORIES_TITLE}</h2>
    <ul class="nav nav-pills nav-stacked">
	  {foreach from=$CATEGORIES item=item}
	  <li{if isset($item.active)} class="active"{/if}>
		<a href="{$item.link}">{$item.name}</a>
	  </li>
      {/foreach}
    </ul>
  </div>
</div>