<?php if (!isset($webpage)) die('Direct access not allowed'); ?>
<div class="grid_buttons"><?php echo HtmlControls::GenerateFormButtons($trans['general.save'], 'frm.FormSaveData()', $webpage->PageReturnUrl, $trans['categories_import.items_list'])?>
<?php if ($dataView->EditId != 0) 
	{ 
		echo HtmlControls::GenerateNewItemButton('category_edit.php', $trans['categories_import.new_item']);
	} ?> 
</div>
<div class="edit_wrapper">
<table class="edit_table">
	<tr>
		<td class="required"><?php echo $trans['categories_import.name']?>: </td>
		<td><input type="text" name="txtName" id="txtName" class="form-control" value="<?php echo $dataView->txtName?>" /></td>
	</tr>
	<tr>
		<td class="required"><?php echo $trans['general.url_key']?>:  &nbsp; &nbsp; <a href="javascript:;" title="<?php echo $trans['general.regenerate_url_key']?>" id="lnkRegenerateUrlKey" tabindex="-1"><i class="fa fa-refresh"></i></a></td>
		<td><input type="text" name="txtUrlKey" id="txtUrlKey" class="form-control" value="<?php echo $dataView->txtUrlKey?>" /></td>
	</tr>
	<tr>
		<td class="required"><?php echo $trans['categories_import.parent']?>:</td>
		<td>
			<select name="ddlParentId" id="ddlParentId" class="form-control" >
				<?php echo $dataView->categoriesList?>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php echo $trans['categories_import.description']?>: </td>
		<td><textarea name="txtDescription"  id="txtDescription" class="tinymce" rows="20" cols="60"><?php echo $dataView->txtDescription?></textarea></td>
	</tr>
	<tr>
		<td><?php echo $trans['categories_import.short_description']?>: </td>
		<td><textarea name="txtShortDescription"  id="txtShortDescription" class="tinymce" rows="10" cols="60"><?php echo $dataView->txtShortDescription?></textarea></td>
	</tr>
	<tr>
		<td><?php echo $trans['general.seo_title']?>: </td>
		<td><input type="text" name="txtSeoTitle" id="txtSeoTitle"  class="form-control" value="<?php echo $dataView->txtSeoTitle?>" maxlength="80" /></td>
	</tr>
	<tr>
		<td><?php echo $trans['general.seo_description']?>: </td>
		<td><input type="text" name="txtSeoDescription" id="txtSeoDescription"  class="form-control" value="<?php echo $dataView->txtSeoDescription?>" maxlength="160" /></td>
	</tr>
	<tr>
		<td><?php echo $trans['general.seo_keywords']?>: </td>
		<td><input type="text" name="txtSeoKeywords" id="txtSeoKeywords"  class="form-control" value="<?php echo $dataView->txtSeoKeywords?>" maxlength="160" /></td>
	</tr>
	<tr>
		<td><?php echo $trans['categories_import.is_active']?>: </td>
		<td><input type="checkbox" name="chkStatus" id="chkStatus"  class="" value="" <?php echo $dataView->chkStatus?> /></td>
	</tr>
	<tr>
		<td><?php echo $trans['categories_import.image']?>: <span class="required_field">*</span> <br/></td>
		<td>
			<?php if ($dataView->txtFile == '') { ?>
			<input type="file" name="fileUpload" id="fileUpload" value="" class="form-control" />
			<?php } else 
			{
			?>
				<img src="<?php echo $dataView->txtFile?>" alt="" />
				<a href="javascript:;" onclick="frm.FormSubmitAction('DeleteFile')"><?php echo $trans['general.delete']?></a>
		<?php } ?>
		</td>
	</tr>				
</table>
</div>
<div class="grid_buttons"><?php echo HtmlControls::GenerateFormButtons($trans['general.save'], 'frm.FormSaveData()', $webpage->PageReturnUrl, $trans['categories_import.items_list'])?></div>