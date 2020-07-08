<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container col-sm-4 col-md-7 col-lg-4 mt-5">
    <div class="card">
        <h3 class="card-header" id="monthAndYear"></h3>
        <table class="table table-bordered table-responsive-sm" id="calendar">
            <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            </thead>

            <tbody id="calendar-body">

            </tbody>
        </table>

        <div class="form-inline">

            <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Previous</button>

            <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Next</button>
        </div>
        <br/>
        <form class="form-inline">
            <label class="lead mr-2 ml-2" for="month">Jump To: </label>
            <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                <option value=0>Jan</option>
                <option value=1>Feb</option>
                <option value=2>Mar</option>
                <option value=3>Apr</option>
                <option value=4>May</option>
                <option value=5>Jun</option>
                <option value=6>Jul</option>
                <option value=7>Aug</option>
                <option value=8>Sep</option>
                <option value=9>Oct</option>
                <option value=10>Nov</option>
                <option value=11>Dec</option>
            </select>


            <label for="year"></label>
        <select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023" selected>2023</option>
        </select>

        <input type="text" name="year" class="year" value="" style="display: none;">
        <input type="text" name="month" class="month" value="" style="display: none;">
    </form>

        <div class="hidden_input" style="display: none;">
                <input class="checked_day" type="checkbox" name="check_number[]" value="1">
                <input class="checked_day" type="checkbox" name="check_number[]" value="2">
                <input class="checked_day" type="checkbox" name="check_number[]" value="3">
                <input class="checked_day" type="checkbox" name="check_number[]" value="4">
                <input class="checked_day" type="checkbox" name="check_number[]" value="5">
                <input class="checked_day" type="checkbox" name="check_number[]" value="6">
                <input class="checked_day" type="checkbox" name="check_number[]" value="7">
                <input class="checked_day" type="checkbox" name="check_number[]" value="8">
                <input class="checked_day" type="checkbox" name="check_number[]" value="9">
                <input class="checked_day" type="checkbox" name="check_number[]" value="10">
                <input class="checked_day" type="checkbox" name="check_number[]" value="11">
                <input class="checked_day" type="checkbox" name="check_number[]" value="12">
                <input class="checked_day" type="checkbox" name="check_number[]" value="13">
                <input class="checked_day" type="checkbox" name="check_number[]" value="14">
                <input class="checked_day" type="checkbox" name="check_number[]" value="15">
                <input class="checked_day" type="checkbox" name="check_number[]" value="16">
                <input class="checked_day" type="checkbox" name="check_number[]" value="17">
                <input class="checked_day" type="checkbox" name="check_number[]" value="18">
                <input class="checked_day" type="checkbox" name="check_number[]" value="19">
                <input class="checked_day" type="checkbox" name="check_number[]" value="20">
                <input class="checked_day" type="checkbox" name="check_number[]" value="21">
                <input class="checked_day" type="checkbox" name="check_number[]" value="22">
                <input class="checked_day" type="checkbox" name="check_number[]" value="23">
                <input class="checked_day" type="checkbox" name="check_number[]" value="24">
                <input class="checked_day" type="checkbox" name="check_number[]" value="25">
                <input class="checked_day" type="checkbox" name="check_number[]" value="26">
                <input class="checked_day" type="checkbox" name="check_number[]" value="27">
                <input class="checked_day" type="checkbox" name="check_number[]" value="28">
                <input class="checked_day" type="checkbox" name="check_number[]" value="29">
                <input class="checked_day" type="checkbox" name="check_number[]" value="30">
                <input class="checked_day" type="checkbox" name="check_number[]" value="31">
            </div>

    </div>

    @foreach($schedule as $s)
        <div class="from_db" style="display: none;">
        <input type="" name="event_name" class="name_db" value="{{ $s->name }}">
        <input type="" name="date_db" class="date_db" value="{{ $s->date }}">
        </div>
    @endforeach

    <div class="schedule" style="display: none; margin-bottom: 100px;">
    <div class="container" style="margin-top: 100px;">
        <h2>Enter schedule</h2>
        <form method="POST" action="/post-schedule">
            @csrf
            <div class="form-group">
              <label for="uname">Event:</label>
              <input type="text" class="form-control" id="event" placeholder="Enter event" name="event" required>
            </div>
            <div class="form-group">
              <label for="uname">Date:</label>
              <input type="text" class="form-control" id="date" name="date" value="" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>

    <div class="schedule_edit" style="display: none; margin-bottom: 100px;">
    <div class="container" style="margin-top: 100px;">
        <h2>Update schedule</h2>
        <form method="POST" action="/edit-schedule">
            @method('PATCH')
            @csrf
            <div class="form-group">
              <label for="uname">Event:</label>
              <input type="text" class="form-control" id="event_edit" name="event_edit" required>
            </div>
            <div class="form-group">
              <label for="uname">Date:</label>
              <input type="text" class="form-control" id="date_edit" name="date" value="" required>
            </div>
            <button type="submit" class="btn btn-primary" style="float: left;">Update</button>
            </form>
            <form class="delete" method="POST" action="">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-primary" style="float: left; margin-left: 5%;">X</button>
            </form>
    </div>
    </div>


</div>
<!--<button name="jump" onclick="jump()">Go</button>-->
<script src="scripts.js"></script>

<!-- Optional JavaScript for bootstrap -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>

<script src="/js/main.js"></script>


</body>
</html>