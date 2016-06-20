<form id="add_complaint" name="add_complaint" method="POST"> 
	<div class="form-group required">
		<label class="control-label">Ім'я<br><input class="form-control " name="name" type="text" size="55" required="required"></label>
	</div>
	<div class="form-group">
		<label>E-mail <span class="stars">*</span><br><input class="form-control" type="email" name="email" size="55" required></label>
	</div>
	<div class="form-group">
		<label>Сайт <br><input class="form-control" type="text" name="website" size="55"></label>
	</div>
	<div class="form-group">
		<label>Код безпеки <span class="stars">*</span><br>
		<div class="col-md-3">
			<div class="captcha"><img alt="Код безпеки" title="Оновити код" onclick="reload_capcha();" src="/libs/capcha/secpic.php"></div>
		</div>
		<div class="col-md-3">
			<input class="form-control" type="text" name="capcha" maxlength="4"  required></label>
		</div>
	</div>
	<br><br><br>
	<div class="form-group">
		<label>текст <span class="stars">*</span><br><textarea class="form-control" name="text" type="text" cols="55" rows="3" required></textarea></label>
	</div>
	<div class="form-group text-right">
		<button type="submit"  class="btn btn-primary" size="55">Відправити</button>
	</div>
	
</form>