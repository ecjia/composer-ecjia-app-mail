<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.mail_events_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link} 
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid search_page">
	<div class="span12">
         <div class="search_panel clearfix">
		   <!-- {foreach from=$data item=val} -->
           	 <div class="search_item clearfix">
           	  	<div class="pull-right">
	                <a class="change_status" style="cursor: pointer;"  data-msg='{if $val.status eq 'open'}{t domain="mail"}您确定要关闭该邮件事件吗？{/t}{else}{t domain="mail"}您确定要开启该邮件事件吗？{/t}{/if}' data-href='{if $val.status eq "open"}{url path="mail/admin_events/close" args="code={$val.code}&id={$val.id}"}{else}{url path="mail/admin_events/open" args="code={$val.code}&id={$val.id}"}{/if}' >
                       {if $val.status eq 'open'}
                       <button class="btn btn-mini btn-success" type="button" style="margin-top: 20px;">{t domain="mail"}点击关闭{/t}</button>
                       {else}
                       <button class="btn btn-mini" type="button" style="margin-top: 20px;">{t domain="mail"}点击开启{/t}</button>
                       {/if}
	                </a>        
                </div>
                
                <div class="search_content" style="padding-left: 0px;">
                    <h4>
                        <a class="sepV_a" style="text-decoration:none;">{$val.name}</a>{if $val.status eq 'open'}<span class="label label-info">{t domain="mail"}开启中{/t}</span>{else}<span class="label">{t domain="mail"}已关闭{/t}</span>{/if}
                    </h4>
                    <p class="sepH_a"><strong>{$val.code}</strong></p>
                    <p class="sepH_b item_description">{$val.description}</p>
                </div>
                
             </div>
         <!-- {/foreach} -->  
        </div>
	</div>
</div>
<!-- {/block} -->