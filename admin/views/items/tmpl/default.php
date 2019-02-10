<?php defined('_JEXEC') or die;
/*
 * @package     com_vlogs
 * @copyright   Copyright (C) 2018 Aleksey A. Morozov (AlekVolsk). All rights reserved.
 * @license     GNU General Public License version 3 or later; see http://www.gnu.org/licenses/gpl-3.0.txt
 */

JHtml::_('jquery.framework');
?>

<form action="<?php echo JRoute::_('index.php?option=com_vlogs&view=items'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-main-container">
		
		<div id="view_items_list"></div>
		
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
		
	</div>
</form>
<style>
.com_vlogs pre {box-sizing:border-box;max-width:100%;width:100%;}
</style>			
<script>
document.addEventListener('DOMContentLoaded', function()
{
	getLog = function(vfile)
	{
		Joomla.removeMessages();

		document.querySelector('#view_items_list').innerHTML = '';
		document.querySelector('#view_count_items').innerHTML = '0';

		jQuery.getJSON('index.php', {option:'com_vlogs', task:'getAjax', action:'List', filename:vfile}, function(response)
		{
			document.querySelector('#view_items_list').innerHTML = response.message;
			document.querySelector('#view_count_items').innerHTML = response.count;
		});
	}
	
	document.querySelector('#view_refresh_file').addEventListener('click', function(e)
	{
		getLog(document.querySelector('#view_select_files').value);
	});
	
	document.querySelector('#view_download_file').addEventListener('click', function(e)
	{
		Joomla.removeMessages();
		document.location.href = 'index.php?option=com_vlogs&task=getAjax&action=dwFile&bom=0&filename=' + document.querySelector('#view_select_files').value;
	});
	
	document.querySelector('#view_download_bom_file').addEventListener('click', function(e)
	{
		Joomla.removeMessages();
		document.location.href = 'index.php?option=com_vlogs&task=getAjax&action=dwFile&bom=1&filename=' + document.querySelector('#view_select_files').value;
	});
	
	document.querySelector('#view_delete_file').addEventListener('click', function(e)
	{
		Joomla.removeMessages();
		jQuery.getJSON('index.php', {option:'com_vlogs', task:'getAjax', action:'DelFile', filename:document.querySelector('#view_select_files').value}, function(response)
		{
			if (response.result)
			{
				var sel = document.querySelector('#view_select_files');
				sel.removeChild(sel.options[sel.selectedIndex]);
				getLog(sel.value);
			}
			else
			{
				Joomla.JText.load({error:"<?php echo JText::_('ERROR'); ?>"});
				Joomla.renderMessages({'error':[response.message]});
			}
		});
	});

	document.querySelector('#view_select_files').addEventListener('change', function(e)
	{
		getLog(e.target.value);
	});
	
	document.querySelector('#view_archive_file').addEventListener('click', function(e)
	{
		Joomla.removeMessages();
		jQuery.getJSON('index.php', {option:'com_vlogs', task:'getAjax', action:'ArchiveFile', filename:document.querySelector('#view_select_files').value}, function(response)
		{
			if (response.result)
			{
				Joomla.JText.load({info:"<?php echo JText::_('INFO'); ?>"});
				Joomla.renderMessages({'info':[response.message]});
			}
			else
			{
				Joomla.JText.load({error:"<?php echo JText::_('ERROR'); ?>"});
				Joomla.renderMessages({'error':[response.message]});
			}
		});
	});

	getLog(document.querySelector('#view_select_files').value);
});
</script>
