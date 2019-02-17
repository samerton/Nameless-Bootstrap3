<h3>{$FORUM_TAB_TITLE}</h3>

{if isset($NO_POSTS)}
  <p>{$NO_POSTS}</p>
{else}
  <hr />
  <h4>{$PF_LATEST_POSTS_TITLE}</h4>
  {foreach from=$PF_LATEST_POSTS item=post}
  <div class="panel panel-default">
    <div class="panel-heading">
	  <a href="{$post.link}">{$post.title}</a>
	</div>
	<div class="panel-body">
	  <div class="forum_post">
	    {$post.content}
	  </div>
	  <span class="pull-right">
	    <span rel="tooltip" title="{$post.date_full}">{$post.date_friendly}</span>
	  </span>
	</div>
  </div>
  <br />
  {/foreach}
{/if}