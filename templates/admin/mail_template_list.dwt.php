<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.mail_template_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">
			<!-- {if $ur_here}{$ur_here}{/if} -->
            {$action_links}
		</h3>
	
		<table class="table table-striped smpl_tbl dataTable table-hide-edit" id="plugin-table">
			<thead>
				<tr>
					<th class="w150">{t domain="push"}模板代号{/t}</th>
					<th class="w150">{t domain="push"}消息主题{/t}</th>
					<th>{t domain="push"}模板内容{/t}</th>
				</tr>
			</thead>
			<tbody>
				<!-- {foreach from=$template item=list} -->
				<tr>
					 <td class="hide-edit-area hide_edit_area_bottom">{$list.template_code}
						<div class="edit-list">
						 <a class="data-pjax no-underline" href='{url path="push/admin_template/edit" args="id={$list.id}&channel_code=push_umeng&event_code={$list.template_code}"}' title='{t domain="push"}编辑{/t}'>{t domain="push"}编辑{/t}</a>&nbsp;|&nbsp;
		                 <a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg='{t domain="push"}您确定要删除该消息模板吗？{/t}' href='{RC_Uri::url("push/admin_template/remove", "id={$list.id}&channel_code=push_umeng")}' title='{t domain="push"}删除{/t}'>{t domain="push"}删除{/t}</a>
		                &nbsp;|&nbsp; <a class="data-pjax no-underline" href='{url path="push/admin_template/test" args="id={$list.id}&channel_code=push_umeng&event_code={$list.template_code}"}'  title='{t domain="push"}推送消息测试{/t}'>{t domain="push"}推送消息测试{/t}</a>
						</div>
					 </td>
					<td>{$list.template_subject}</td>
					<td>{$list.template_content}</td>
				</tr>
				<!-- {/foreach} -->
			</tbody>
		</table>
	</div>
</div>
<!-- {/block} -->