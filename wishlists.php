<?php
date_default_timezone_set("America/Chicago");
$now = new \DateTime('now');
$nowMonth = $now->format('m');

$people = array(
   array('bday' => '01-30', 'name' => 'Bandit', 'pic' => 'bandit.png', 'wlist' => 'https://link.to/wishlist/bandit'),
   array('bday' => '02-11', 'name' => 'Chilli', 'pic' => 'chilli.png', 'wlist' => '.'),
   array('bday' => '10-23', 'name' => 'Bob', 'pic' => 'bob.png',  'wlist' => '.'),
   array('bday' => '05-20', 'name' => 'Nana', 'pic' => 'nana.png', 'wlist' => '.'),
   array('bday' => '08-26', 'name' => 'Bluey', 'pic' => 'bluey.png', 'wlist' => '.'),
   array('bday' => '10-30', 'name' => 'Bingo', 'pic' => 'bingo.png', 'wlist' => '.')
   );

$sortKey = array_map(function($p) {
  $t = new DateTime();
  $t->setTime(0,0,0);
  $next = DateTime::createFromFormat('m-d-Y', $p['bday'] . '-' . $t->format('Y'));
  $next->setTime(0,0,0);

  if($next < $t) {
    $next = $next->modify('+1 year');
  }
  
  return $next->getTimestamp();
}, $people);

//sort the array
array_multisort($sortKey, SORT_ASC, $people);

// set name and date for person 1 and replace dash
$name = $people[0]['name'];
$termin = $people[0]['bday'];
$pic = $people[0]['pic'];
$wlist = $people[0]['wlist'];
$geburtstag = str_replace("-", ".", "$termin").".";


?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Who's Next?</title>
<style>
    html { background-color: #0000000A; }
    a { color: white; }
    h1 {
      text-align: center;
      color: white;
      font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
      font-size: 425%;
    }
    h2 {
      text-align: center;
      color: white;
      font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
      font-size: 175%;
    }

    body { background-color:#33A; }


@keyframes float {
	0% {
		box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
		transform: translatey(0px);
	}
	50% {
		box-shadow: 0 25px 15px 0px rgba(0,0,0,0.2);
		transform: translatey(-20px);
	}
	100% {
		box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
		transform: translatey(0px);
	}
}

.container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
}

.container2 {
	width: 100%;
	height: 100%;
	display: flex;
	flex-direction: row;
	justify-content: center;
	align-items: center;
	gap: 10px;
	position: relative;
  	border-bottom: 1px dotted black;
}

.avatar {
	width: 500px;
	height: 500px;
	box-sizing: border-box;
	border: 5px white solid;
	border-radius: 50%;
	overflow: hidden;
	box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
	transform: translatey(0px);
	animation: float 4s ease-in-out infinite;
	img { width: 100%; height: auto; }
}

.avatarbox {
	position: relative;
	text-align: center;
	color: white;
}
.avatar2 {
        width: 200px;
        height: 200px;
        box-sizing: border-box;
        border: 5px white solid;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
        //transform: translatey(0px);
        //animation: float 4s ease-in-out infinite;
        img { width: 100%; height: auto;   transition: all 0.3s; max-width: 100%;}
        margin: 0px;
        min-width: 200px;
        max-width: 200px;
        //width: 100%;
	color: rgb(119, 162, 241);
	.details {
 	   visibility: hidden;
 	   position: absolute;
 	   top: -10%;
  	   left: 50%;
  	   transform: translate(-50%, -50%);
	}
}

.avatar2:hover {
    img {
          //transform: rotate(5deg);
          animation: rotation .5s infinite linear;
        }
    .details {visibility: visible;}
}


@keyframes rotation {
  50% {
    transform: rotate(3deg);
  }
  100% {
    transform: rotate(-3deg);
  }
}

</style>
</head>

<body>
<h1>
<div class="container">
<div class="avatar">
<?php
echo "<a href=\"$wlist\"><img src=\"./pics/$pic\"></img></a>";
?>
</div>
</div>
<?php
echo "$name has the next birthday on $termin";
?>
</h1>
<br>
<h2>

<div class="container2">
<?php 
// Write code to loop through the rest displaying name, tooltip of dates
$length = count($people);
for ($i = 1; $i < $length; $i++) {
	$name2 = $people[$i]['name'];
	$bday2 = $people[$i]['bday'];
	$pic2 = $people[$i]['pic'];
	$wlist2 = $people[$i]['wlist'];
	echo "<div class=\"avatar2\"><a href=\"$wlist2\"><img src=\"pics/$pic2\"></a><span class=\"details\">$name2: $bday2</p></div>";
}
?>
</div>
</h2>

</body>
</html>
