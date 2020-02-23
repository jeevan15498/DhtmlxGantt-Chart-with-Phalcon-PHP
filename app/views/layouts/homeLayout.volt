<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- https://docs.phalcon.io/3.4/en/tag#changing-dynamically-the-document-title -->
  <!-- <?= $this->tag->getTitle(); ?> -->
  {{ getTitle() }}
  <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
  <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
  <style>
		html, body {
			height: 100%;
			padding: 0px;
			margin: 0px;
			overflow: hidden;
		}
	</style>
</head>

<body>
  {{ content() }}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</body>

</html>