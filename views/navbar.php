<!-- nav bar -->
<nav class="navbar">
	<div class="container">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Книга скарг та пропозицій</a>
		</div>
		
        <div id="navbar" class="navbar-collapse collapse">

			<? if ($is_admin == false):?>
				<div class="col-md-3">
					<button title="Додати нове повідомлення" type="button" class="btn btn-primary" style="margin: 8px 0;" data-toggle="modal" data-target="#add_complaint_dialog" >+</button>
				</div>
			<?endif;?>
			
			<? if ($is_admin == false):?>
			<form name="login_form" id="login_form" method="POST" class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" placeholder="Логін" name="login" class="form-control " maxlength="25" required>
				</div>
				<div class="form-group">
					<input type="password" placeholder="Пароль" name="pass" maxlength="25" class="form-control" required>
				</div>
				<button type="submit" class="btn btn-success">Ввійти<span class="loading-p"></span></button>
				
			</form>

			<? else:?>
			 <div class="navbar-header pull-right" style="padding: 8px;">
				<img src="/img/user.png" class="avatar"><span><strong><?= $user_name;?> (Модератор)</strong></span>&nbsp;&nbsp;<button type="button" id="logout" data-toggle="modal" class="btn btn-default" data-target="#myModal">вийти</button>
			</div>
			<? endif;?>
		</div><!--/.navbar-collapse -->
	</div>
</nav>