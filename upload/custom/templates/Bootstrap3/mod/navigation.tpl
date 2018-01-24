<div class="panel panel-default">
  <div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
	  {foreach from=$MOD_LINKS key=name item=item}
	  <li{if isset($item.active)} class="active"{/if}>
		<a href="{$item.link}" target="{$item.target}">{$item.title}</a>
	  </li>
      {/foreach}
    </ul>
  </div>
</div>