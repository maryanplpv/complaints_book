<div class="container" id="content">

<? if (!isset($complaints)): ?>
<div class="alert alert-success" role="alert">Записів немає</div>
<? return false; endif;?>

<table class="table table-striped">
	<thead>
		<tr class="sorting-radio">
			<th width="<? if ($is_admin == true):?>18%<?else:?>20%<?endif;?>">дата додавання <input type="radio" name="sort" id="datetime"><label for="datetime" class="glyphicon glyphicon-triangle-top"></label><input type="radio" name="sort" id="datetime_desc"><label for="datetime_desc" class="glyphicon glyphicon-triangle-bottom"></label></a></th>
			<th width="<? if ($is_admin == true):?>20%<?else:?>30%<?endif;?>">повідомлення</th>
			<th width="18%">Ім’я <input type="radio" name="sort" id="name"><label for="name" class="glyphicon glyphicon-triangle-top"></label><input type="radio" name="sort" id="name_desc"><label for="name_desc" class="glyphicon glyphicon-triangle-bottom"></label></a></th>
			<th width="<? if ($is_admin == true):?>14%<?else:?>18%<?endif;?>">e-mail <input type="radio" name="sort" id="email"><label for="email" class="glyphicon glyphicon-triangle-top"></label><input type="radio" name="sort" id="email_desc"><label for="email_desc" class="glyphicon glyphicon-triangle-bottom"></label></a></th>
			<th width="18%">сайт</th>
			<? if ($is_admin == true):?>
				<th width="12%">Дія</th>
			<? endif; ?>
		</tr>
	</thead>
	<tbody>
		<? foreach($complaints as $i=>$v): ?>
		<tr id="item_<?= $v['id'];?>">
			<td><?= date('d-m-Y', strtotime($v['datetime']))?></td>
			<td><?= $v['text'];?></td>
			<td><?= $v['name'];?></td>
			<td><?= $v['email'];?></td>
			<td><?= $v['website'];?></td>
			<td>
				<? if ($is_admin == true):?>
				<button type="button" class="btn btn-sm btn-success" onclick="edit_complaint(<?= $v['id'];?>)">Ред.</button>
				<button type="button" class="btn btn-danger btn-sm" onclick="delete_complaint(<?= $v['id'];?>);">Вид.</button>
				<? endif;?>
			</td>
		</tr>
		<? endforeach;?>
		
	</tbody>
</table>


<ul class="pagination">
	<? for ($page=1; $page<=$total_pages; $page++):?>
		<li <? if ($page == $active_page): ?> class="active" <?endif;?>><a href="javascript://" onclick="get_complaints_list(<?= $page;?>)"  ><?= $page;?></a></li>
	<? endfor;?>	
</ul>

</div>
