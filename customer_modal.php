<?php
include 'connection.php';
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  if (!empty($name) && !empty($phone) && !empty($zip)) {
    $query = "INSERT INTO `customer`(`c_name`, `c_phone`, `c_address`, `city`, `zip`)
   VALUES ('$name','$phone','$address','$city','$zip')";

    if ($query) {
      $result = mysqli_query($conn, $query);
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal form</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    label,
    input {
      display: block;
    }

    input.text {
      margin-bottom: 12px;
      width: 95%;
      padding: .4em;
    }

    fieldset {
      padding: 0;
      border: 0;
      margin-top: 25px;
    }

    h1 {
      font-size: 1.2em;
      margin: .6em 0;
    }

    div#users-contain {
      width: 350px;
      margin: 20px 0;
    }

    div#users-contain table {
      margin: 1em 0;
      border-collapse: collapse;
      width: 100%;
    }

    div#users-contain table td,
    div#users-contain table th {
      border: 1px solid #eee;
      padding: .6em 10px;
      text-align: left;
    }

    .ui-dialog .ui-state-error {
      padding: .3em;
    }

    .validateTips {
      border: 1px solid transparent;
      padding: 0.3em;
    }
  </style>
  <style>
    .ui-draggable .ui-dialog-titlebar {
      cursor: move;
      background: purple;
    }

    .ui-widget-overlay {
      background: #3b3b3b;
      opacity: 0.6;

    }

    #dialog-form {
      height: 0px;
    }

    .ui-dialog .ui-dialog-buttonpane button {
      margin: 0.5em 0.4em 0.5em 0;
      cursor: pointer;
      background: purple;
      color: white;
      border: none;
      margin-right: 50px;
    }
  </style>

  <style>
    label,
    input {
      display: block;
    }

    input.text {
      margin-bottom: 12px;
      width: 95%;
      padding: .4em;
    }

    fieldset {
      padding: 0;
      border: 0;
      margin-top: 25px;
    }

    h1 {
      font-size: 1.2em;
      margin: .6em 0;
    }

    div#users-contain {
      width: 350px;
      margin: 20px 0;
    }

    div#users-contain table {
      margin: 1em 0;
      border-collapse: collapse;
      width: 100%;
    }

    div#users-contain table td,
    div#users-contain table th {
      border: 1px solid #eee;
      padding: .6em 10px;
      text-align: left;
    }

    .ui-dialog .ui-state-error {
      padding: .3em;
    }

    .validateTips {
      border: 1px solid transparent;
      padding: 0.3em;
    }
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    $(function() {
      var dialog, form,

        // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
        name = $("#name"),
        allFields = $([]).add(name),
        tips = $(".validateTips");

      function updateTips(t) {
        tips
          .text(t)
          .addClass("ui-state-highlight");
        setTimeout(function() {
          tips.removeClass("ui-state-highlight", 1500);
        }, 500);
      }

      function checkLength(o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
          o.addClass("ui-state-error");
          updateTips("Length of " + n + " must be between " +
            min + " and " + max + ".");
          return false;
        } else {
          return true;
        }
      }

      function checkRegexp(o, regexp, n) {
        if (!(regexp.test(o.val()))) {
          o.addClass("ui-state-error");
          updateTips(n);
          return false;
        } else {
          return true;
        }
      }

      function addUser() {
        var valid = true;
        allFields.removeClass("ui-state-error");

        valid = valid && checkLength(name, "username", 3, 16);


        if (valid) {
          dialog.dialog("close");
        }
        return valid;
      }

      dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
          "Save": addUser,
          Cancel: function() {
            dialog.dialog("close");
          
        },
        close: function() {
          form[0].reset();
          allFields.removeClass("ui-state-error");

        },

      });
      form = dialog.find("form").on("submit", function(event) {
        // event.preventDefault();
        addUser();
      });

      $("#create-user").button().on("click", function() {
        dialog.dialog("open");
      });
    });
  </script>

</head>

<body>

  <div id="dialog-form" class="" title="Add New Customer">
    <p class="validateTips ">All form fields are required.</p>

    <form method="post" action="store1.php">
      <div class="row">
        <div class="col">
          <input type="text" id="name" name="name" class="text ui-widget-content ui-corner-all" placeholder="First name" aria-label="First name">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" id="phone" name="phone" class="text ui-widget-content ui-corner-all" placeholder="+92..." aria-label="">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" id="address" name="address" class="text ui-widget-content ui-corner-all" placeholder="address" aria-label="Address">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" id="city" name="city" class="text ui-widget-content ui-corner-all" placeholder="City" aria-label="Enter city">
        </div>
        <div class="col">
          <input type="text" id="zip" name="zip" class="text ui-widget-content ui-corner-all" placeholder="zip" aria-label="Enter Zip code">
        </div>
      </div>
      <input type="submit" tabindex="-1" name="submit" class="btn btn-success mx-5 my-2">
      <input type="reset" id="reset" tabindex="-1" name="reset" class="btn btn-warning">
      </fieldset>
    </form>
  </div>
</body>

</html>