<?php

$fixtures = [];

$participants = ['Liverpool', 'Man Utd', 'Arsenal', 'Chelsea', 'Leicester', 'Everton'];
$teamsCount = count($participants);
$rounds = $teamsCount - 1;
$matchesPerRound = $teamsCount / 2;

$awayTeams = array_splice($participants, $matchesPerRound);
$homeTeams = $participants;

for ($r = 0; $r < $rounds; $r++) {
    for ($m = 0; $m < $matchesPerRound; $m++) {
        $homeParticipant = $homeTeams[$m];
        $awayParticipant = $awayTeams[$m];

        $fixtures[] = ['home'=> $homeParticipant, 'away' => $awayParticipant];
    }
    $spliced = array_splice($homeTeams, 1, 1);
    $secondHomeTeam = array_shift($spliced);
    array_unshift($awayTeams, $secondHomeTeam);

    $lastAwayTeam = array_pop($awayTeams);
    array_push($homeTeams, $lastAwayTeam);
}

var_dump($fixtures);
?>

<html>
<head>
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function(){
            $('.yellow').on('click', function(e) {
                var id = $(this).attr('data-id');
                var oldValue = ($('#'+id).val());
                var newValue = '';
                if (oldValue == 'no') {
                    newValue = 'yes';
                } else {
                    newValue = 'no';
                }
                $('#'+id).val(newValue);
            });

            $('.red').on('click', function(e) {
                var id = $(this).attr('data-id');
                var oldValue = ($('#'+id).val());
                var newValue = '';
                if (oldValue == 'no') {
                    newValue = 'yes';
                } else {
                    newValue = 'no';
                }
                $('#'+id).val(newValue);
            });

            $('.increase_goals').on('click', function(e) {
                var id = $(this).attr('data-id');
                var oldValue = parseInt($('#'+id).val());
                var newValue = oldValue + 1;
                $('#'+id).val(newValue);
                $('.'+id).text(newValue);
            });

            $('.decrease_goals').on('click', function(e) {
               var id = $(this).attr('data-id');
               var oldValue = parseInt($('#'+id).val());
               if (oldValue > 0) {
                   var newValue = oldValue - 1;
                   $('#'+id).val(newValue);
                   $('.'+id).text(newValue);
               }
            });

            $('#testform').on('submit', function(e) {
                alert("Hello");
            });
        });
    </script>
</head>
<body>
<form id="testform" action="" method="POST">
    Michael Owen:<br>
    <input id="yellows_1" type="hidden" name="yellows[1]" value="no" autocomplete="off">
    <a class="yellow" data-id="yellows_1" href="#">yellow</a>
    <input id="reds_1" type="hidden" name="reds[1]" value="no" autocomplete="off">
    <a class="red" data-id="reds_1" href="#">red</a>
    <input id="goals_1" type="hidden" name="goals[1]" value="0" autocomplete="off">
    <span class="goals_1">0</span>
    <a class="increase_goals" data-id="goals_1" href="#">+</a>
    <a class="decrease_goals" data-id="goals_1" href="#">-</a>
    <br>
    Robbie Fowler:<br>
    <input id="goals_1" type="hidden" name="goals[2]" value="0" autocomplete="off"> + -
    <br><br>
    <input id="submit" name="submit" type="submit" value="Submit">
</form>
</body>
</html>
