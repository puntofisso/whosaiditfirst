<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--link rel="icon" href="favicon.ico"-->

    <title>Who said it first?</title>

    <!--link rel="canonical" href=""-->

    <!-- Bootstrap core CSS -->
    <link href="hansard-assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="hansard-assets/css/signin.css" rel="stylesheet">
  </head>

<style>
body {
  background: url('hansard-assets/westminster.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
</style>

  <body class="text-center">
    <form class="form-signin col-xs-6">
      <h1 class="h1 mb-3 font-weight-normal">Who said it first (*) in the UK House of Commons?</h1>

      <label for="inputText" class="sr-only">Email address</label>
      <input type="text" id="inputText" class="form-control" placeholder="Try phrases like &quot;Brexit means Brexit&quot;" required autofocus>
      <button id="searchBtn" class="btn btn-lg btn-primary btn-block" type="submit">Search!</button>

<hr/>

<div class="container clearfix">
  <h2 id="answer"></h2>
</div>
<span id="disclaimer">(*) it might not be exactly the first, as the records I use only start in 1919 and the UK Parliament has existed for centuries without actual transcripts</span>

   </form>

<script src="hansard-assets/js/jquery-3.5.1.min.js"></script>


<script>

function formatDate(date) {

const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

    var d = new Date(date),
        month = '' + monthNames[(d.getMonth())],
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;


    return [day, month, year].join(' ');
}

$('#searchBtn').click(function(e){
  e.preventDefault();
  query = $('#inputText').val();
  queryurl = 'http://parli-n-grams.puntofisso.net/hansard-query.php'
  querydata = encodeURIComponent(query);


  $.ajax({

	url: queryurl,
        data: "query=" + querydata,
	dataType: 'json',
	async: true,
	success: function(data)
		{
			if (data.length>0) {
				who = data[0]
				speakername = who['speakername'];
				mydate = who['date'];
				myid = ((who['id']).split("/"))[2];
				newdatestr = formatDate(mydate);
				$('#answer').html("It was " + speakername + " on " + newdatestr + ". See <a href='https://www.theyworkforyou.com/debates/?id=" + myid +"'>here for Hansard</a>.");
			} else {
				$('#answer').html("I have no records of this phrase");
			}
		}
	,
	error: function(x, t, m) {
 		alert(error);
	}});


});



</script>

<footer class="footer">
&copy; 2020 <a href="http://www.puntofisso.net">@puntofisso</a> – Data via <a href="https://www.theyworkforyou.com/">TheyWorkForYou</a> – Photo by <a href="https://unsplash.com/@photoart2018?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Andrew Buchanan</a> on <a href="https://unsplash.com/s/photos/uk-parliament?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a>
</footer>

<!--footer class="footer">
      <div class="container inner-wrap clearfix">
        <span class="text-muted">
&copy; 2020 <a href="http://www.puntofisso.net">@puntofisso</a> – Data via <a href="https://www.theyworkforyou.com/">TheyWorkForYou</a> – Photo by <a href="https://unsplash.com/@photoart2018?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Andrew Buchanan</a> on <a href="https://unsplash.com/s/photos/uk-parliament?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span>
      </div>
  </footer-->
  </body>


</html>
