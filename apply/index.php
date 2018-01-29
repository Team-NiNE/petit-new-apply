<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity=sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN crossorigin="anonymous">
		<title>{{sitename}} Apply</title>
	</head>

	<body>
		<form action="./getForm.php" method="POST"> <!-- TODO: AJAX -->
			<center>
			<input placeholder="osu! Username" name="username" style="margin-right: 5px;" required/>
			<label class="radio-inline"><input type="radio" name="mode" value="osu" required>osu!</label>
			<label class="radio-inline"><input type="radio" name="mode" value="taiko">Taiko</label>
			<label class="radio-inline"><input type="radio" name="mode" value="ctb">CatchTheBeat</label>
			<label class="radio-inline"><input type="radio" name="mode" value="mania">osu!mania</label>
			<button type="submit" class="btn btn-info" style="margin-left: 25px;"><i class="fa fa-sign-in" style="margin-right: 5px;"></i>Next</button>
			</center>
		</form>
	</body>
</html>